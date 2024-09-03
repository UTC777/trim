<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyContentSectionRequest;
use App\Http\Requests\StoreContentSectionRequest;
use App\Http\Requests\UpdateContentSectionRequest;
use App\Models\ContentSection;
use App\Models\ContentPage;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContentSectionController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('content_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContentSection::with(['pages'])->select(sprintf('%s.*', (new ContentSection())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'content_section_show';
                $editGate = 'content_section_edit';
                $deleteGate = 'content_section_delete';
                $crudRoutePart = 'content-sections';

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
            $table->editColumn('section_title', function ($row) {
                return $row->section_title ? $row->section_title : '';
            });
            $table->editColumn('order', function ($row) {
                return $row->order ? $row->order : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? ContentSection::LOCATION_SELECT[$row->location] : '';
            });
            $table->editColumn('published', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->published ? 'checked' : null) . '>';
            });
            $table->editColumn('pages', function ($row) {
                $labels = [];
                foreach ($row->pages as $page) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $page->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'published', 'pages']);

            return $table->make(true);
        }

        return view('admin.contentSections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('content_section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id');

        return view('admin.contentSections.create', compact('pages'));
    }

    public function store(StoreContentSectionRequest $request)
    {
        $contentSection = ContentSection::create($request->all());
        $contentSection->pages()->sync($request->input('pages', []));

        return redirect()->route('admin.content-sections.index');
    }

    public function edit(ContentSection $contentSection)
    {
        abort_if(Gate::denies('content_section_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id');

        $contentSection->load('pages');

        return view('admin.contentSections.edit', compact('contentSection', 'pages'));
    }

    public function update(UpdateContentSectionRequest $request, ContentSection $contentSection)
    {
        $contentSection->update($request->all());
        $contentSection->pages()->sync($request->input('pages', []));

        return redirect()->route('admin.content-sections.index');
    }

    public function show(ContentSection $contentSection)
    {
        abort_if(Gate::denies('content_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentSection->load('pages');

        return view('admin.contentSections.show', compact('contentSection'));
    }

    public function destroy(ContentSection $contentSection)
    {
        abort_if(Gate::denies('content_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentSection->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentSectionRequest $request)
    {
        ContentSection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
