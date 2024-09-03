<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStaticSeoRequest;
use App\Http\Requests\StoreStaticSeoRequest;
use App\Http\Requests\UpdateStaticSeoRequest;
use App\Models\StaticSeo;
use App\Models\Post;
use App\Models\Product;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class StaticSeoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('static_seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StaticSeo::query()->select(sprintf('%s.*', (new StaticSeo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                // $viewGate      = 'static_seo_show';
                $viewGate      = '';
                $editGate      = 'static_seo_edit';
                $deleteGate    = 'static_seo_delete';
                $crudRoutePart = 'static-seos';

                if ($row->post_id && optional($row->post)->slug) {
                    $html = '<a target="_blank" class="btn btn-xs btn-primary mr-1" href="'.route('blog.show', $row->post->slug).'">View</a>';
                } elseif ($row->product_id && optional($row->product)->slug) {
                    $html = '<a target="_blank" class="btn btn-xs btn-primary mr-1" href="'.route('products.show', $row->product->slug).'">View</a>';
                } else {
                    $html = '<a target="_blank" class="btn btn-xs btn-primary mr-1" href="'.url('').'/'.$row->page_path.'">View</a>';
                }

                $html .= view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));

                return $html;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('content_type', function ($row) {
                return $row->content_type ? StaticSeo::CONTENT_TYPE_SELECT[$row->content_type] : '';
            });
            $table->editColumn('menu_name', function ($row) {
                return $row->menu_name ? $row->menu_name : '';
            });
            $table->addColumn('seo_checks', function ($row) {
                if (empty($row->meta_title)) {
                    $mtClass = 'text-white';
                } elseif ($row->meta_title_check == 1) {
                    $mtClass = 'text-success';
                } else {
                    $mtClass = 'text-danger';
                }

                if (empty($row->meta_description)) {
                    $mdClass = 'text-white';
                } elseif ($row->meta_desc_check == 1) {
                    $mdClass = 'text-success';
                } else {
                    $mdClass = 'text-danger';
                }

                if (empty($row->facebook_title)) {
                    $ftClass = 'text-white';
                } elseif ($row->facebook_title_check == 1) {
                    $ftClass = 'text-success';
                } else {
                    $ftClass = 'text-danger';
                }

                if (empty($row->facebook_description)) {
                    $fdClass = 'text-white';
                } elseif ($row->facebook_desc_check == 1) {
                    $fdClass = 'text-success';
                } else {
                    $fdClass = 'text-danger';
                }

                if (empty($row->twitter_title)) {
                    $ttClass = 'text-white';
                } elseif ($row->twitter_title_check == 1) {
                    $ttClass = 'text-success';
                } else {
                    $ttClass = 'text-danger';
                }

                if (empty($row->twitter_description)) {
                    $tdClass = 'text-white';
                } elseif ($row->twitter_desc_check == 1) {
                    $tdClass = 'text-success';
                } else {
                    $tdClass = 'text-danger';
                }

                return '<i class="fas fa-circle '.$mtClass.'" title="Meta Title"></i>
                <i class="fas fa-circle '.$mdClass.'" title="Meta Description"></i>
                <i class="fas fa-circle '.$ftClass.'" title="Facebook Title"></i>
                <i class="fas fa-circle '.$fdClass.'" title="Facebook Description"></i>
                <i class="fas fa-circle '.$ttClass.'" title="Twitter Title"></i>
                <i class="fas fa-circle '.$tdClass.'" title="Twitter Description"></i>';
            });

            $table->rawColumns(['actions', 'placeholder', 'seo_checks']);

            return $table->make(true);
        }

        return view('admin.staticSeos.index');
    }

    public function create()
    {
        abort_if(Gate::denies('static_seo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staticSeos.create');
    }

    public function store(StoreStaticSeoRequest $request)
    {
        $staticSeo = StaticSeo::create($request->all());

        return redirect()->route('admin.static-seos.edit', $staticSeo->id);
    }

    public function edit(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $posts = Post::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.staticSeos.edit', compact('staticSeo', 'posts', 'products'));
    }

    public function update(UpdateStaticSeoRequest $request, StaticSeo $staticSeo)
    {
        if ($request->preview) {
            $validator = Validator::make($request->all(), [
                'page_path' => [
                    'string',
                    'nullable',
                    Rule::unique('static_seos', 'page_path')->ignore($request->id)->whereNull('deleted_at'),
                ],
            ]);

            if ($validator->passes()) {
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        } else {
            $this->validate($request, [
                'page_path' => [
                    'string',
                    'nullable',
                    Rule::unique('static_seos', 'page_path')->ignore($request->id)->whereNull('deleted_at'),
                ],
            ]);
        }

        $staticSeo->update($request->all());

        if ($staticSeo->page) {
            $staticSeo->page()->update(
                [
                    'meta_title' => $staticSeo->meta_title,
                    'meta_description' => $staticSeo->meta_description,
                    'facebook_title' => $staticSeo->facebook_title,
                    'facebook_description' => $staticSeo->facebook_description,
                    'twitter_title' => $staticSeo->twitter_title,
                    'twitter_description' => $staticSeo->twitter_description,
                ]
            );
        }

        Cache::forget("static_seo_{$staticSeo->id}");

        if ($request->preview) {
            if (optional($staticSeo->post)->slug) {
                $url = route('blog.show', $staticSeo->post->slug);
            } elseif (optional($staticSeo->product)->slug) {
                $url = route('products.show', $staticSeo->product->slug);
            } else {
                $url = url('') . '/' . $staticSeo->page_path;
            }

            echo json_encode($url);
        } else {
            return redirect()->route('admin.static-seos.index');
        }
    }

    public function show(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticSeo = StaticSeo::getCached($staticSeo->id);

        return view('admin.staticSeos.show', compact('staticSeo'));
    }

    public function destroy(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticSeo->delete();

        Cache::forget("static_seo_{$staticSeo->id}");

        return back();
    }

    public function massDestroy(MassDestroyStaticSeoRequest $request)
    {
        $staticSeos = StaticSeo::find(request('ids'));

        foreach ($staticSeos as $staticSeo) {
            $staticSeo->delete();
            Cache::forget("static_seo_{$staticSeo->id}");
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('static_seo_create') && Gate::denies('static_seo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new StaticSeo();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

