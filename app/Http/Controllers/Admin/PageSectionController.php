<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyPagesectionRequest;
use App\Http\Requests\StorePagesectionRequest;
use App\Http\Requests\UpdatePagesectionRequest;
use App\Models\ContentPage;
use App\Models\Pagesection;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PageSectionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('pagesection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Pagesection::with(['pages'])->select(sprintf('%s.*', (new Pagesection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'pagesection_show';
                $editGate = 'pagesection_edit';
                $deleteGate = 'pagesection_delete';
                $crudRoutePart = 'pagesections';

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
            $table->editColumn('section', function ($row) {
                return $row->section ? $row->section : '';
            });
            $table->editColumn('section_nickname', function ($row) {
                $nickname = '';
                if($row->use_crud_section==1){
                    $nickname .= '<span class="badge badge-primary">CRUD:</span> ';
                }

                $nickname .= $row->section_nickname ? $row->section_nickname : '';

                return $nickname;
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });

            $table->rawColumns(['actions', 'placeholder','published','section_nickname']);

            return $table->make(true);
        }

        return view('admin.pagesections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pagesection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id');

        return view('admin.pagesections.create', compact('pages'));
    }

    public function store(StorePagesectionRequest $request)
    {
        $pagesection = Pagesection::create($request->all());
        $pagesection->pages()->sync($request->input('pages', []));

        if ($request->input('section_preview', false)) {
            $pagesection->addMedia(storage_path('tmp/uploads/'.$request->input('section_preview')))->toMediaCollection('section_preview');
        }

        return redirect()->route('admin.pagesections.index');
    }

    public function edit(Pagesection $pagesection)
    {
        abort_if(Gate::denies('pagesection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id');

        $pagesection->load('pages');

        return view('admin.pagesections.edit', compact('pages', 'pagesection'));
    }

    public function update(UpdatePagesectionRequest $request, Pagesection $pagesection)
    {
        $pagesection->update($request->all());
        $pagesection->pages()->sync($request->input('pages', []));

        if ($request->input('section_preview', false)) {
            if (! $pagesection->section_preview || $request->input('section_preview') !== $pagesection->section_preview->file_name) {
                if ($pagesection->section_preview) {
                    $pagesection->section_preview->delete();
                }

                $pagesection->addMedia(storage_path('tmp/uploads/'.$request->input('section_preview')))->toMediaCollection('section_preview');
            }
        } elseif ($pagesection->section_preview) {
            $pagesection->section_preview->delete();
        }

        return redirect()->route('admin.pagesections.index');
    }

    public function show(Pagesection $pagesection)
    {
        abort_if(Gate::denies('pagesection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pagesection->load('pages');

        $pagesection = Pagesection::getCached($pagesection->id);

        return view('admin.pagesections.show', compact('pagesection'));
    }

    public function destroy(Pagesection $pagesection)
    {
        abort_if(Gate::denies('pagesection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pagesection->delete();

        return back();
    }

    public function massDestroy(MassDestroyPagesectionRequest $request)
    {
        Pagesection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function remove_section(Request $request)
    {
        $pageSection=PageSection::where('id',$request->id)->first();
        $pageSection->assign_pages()->detach($request->contentPageId);

        echo 1;
    }
}
