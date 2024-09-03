<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySeenonRequest;
use App\Http\Requests\StoreSeenonRequest;
use App\Http\Requests\UpdateSeenonRequest;
use App\Models\Seenon;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SeenonController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('seenon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Seenon::query()->select(sprintf('%s.*', (new Seenon)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'seenon_show';
                $editGate      = 'seenon_edit';
                $deleteGate    = 'seenon_delete';
                $crudRoutePart = 'seenons';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('carousel_image', function ($row) {
                if ($photo = $row->carousel_image) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'carousel_image']);

            return $table->make(true);
        }

        return view('admin.seenons.index');
    }

    public function create()
    {
        abort_if(Gate::denies('seenon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seenons.create');
    }

    public function store(StoreSeenonRequest $request)
    {
        $seenon = Seenon::create($request->all());

        if ($request->input('carousel_image', false)) {
            $seenon->addMedia(storage_path('tmp/uploads/' . basename($request->input('carousel_image'))))->toMediaCollection('carousel_image');
        }

        if ($request->input('featured_image', false)) {
            $seenon->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $seenon->id]);
        }

        return redirect()->route('admin.seenons.index');
    }

    public function edit(Seenon $seenon)
    {
        abort_if(Gate::denies('seenon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seenons.edit', compact('seenon'));
    }

    public function update(UpdateSeenonRequest $request, Seenon $seenon)
    {
        $seenon->update($request->all());

        if ($request->input('carousel_image', false)) {
            if (! $seenon->carousel_image || $request->input('carousel_image') !== $seenon->carousel_image->file_name) {
                if ($seenon->carousel_image) {
                    $seenon->carousel_image->delete();
                }
                $seenon->addMedia(storage_path('tmp/uploads/' . basename($request->input('carousel_image'))))->toMediaCollection('carousel_image');
            }
        } elseif ($seenon->carousel_image) {
            $seenon->carousel_image->delete();
        }

        if ($request->input('featured_image', false)) {
            if (! $seenon->featured_image || $request->input('featured_image') !== $seenon->featured_image->file_name) {
                if ($seenon->featured_image) {
                    $seenon->featured_image->delete();
                }
                $seenon->addMedia(storage_path('tmp/uploads/' . basename($request->input('featured_image'))))->toMediaCollection('featured_image');
            }
        } elseif ($seenon->featured_image) {
            $seenon->featured_image->delete();
        }

        return redirect()->route('admin.seenons.index');
    }

    public function show(Seenon $seenon)
    {
        abort_if(Gate::denies('seenon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.seenons.show', compact('seenon'));
    }

    public function destroy(Seenon $seenon)
    {
        abort_if(Gate::denies('seenon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $seenon->delete();

        return back();
    }

    public function massDestroy(MassDestroySeenonRequest $request)
    {
        $seenons = Seenon::find(request('ids'));

        foreach ($seenons as $seenon) {
            $seenon->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('seenon_create') && Gate::denies('seenon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Seenon();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
