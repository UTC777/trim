<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStoryCategoryRequest;
use App\Http\Requests\StoreStoryCategoryRequest;
use App\Http\Requests\UpdateStoryCategoryRequest;
use App\Models\StoryCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StoryCategoryController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('story_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StoryCategory::query()->select(sprintf('%s.*', (new StoryCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'story_category_show';
                $editGate      = 'story_category_edit';
                $deleteGate    = 'story_category_delete';
                $crudRoutePart = 'story-categories';

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
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'published']);

            return $table->make(true);
        }

        return view('admin.storyCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('story_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.storyCategories.create');
    }

    public function store(StoreStoryCategoryRequest $request)
    {
        $storyCategory = StoryCategory::create($request->all());

        if ($request->input('photo', false)) {
            $storyCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $storyCategory->id]);
        }

        return redirect()->route('admin.story-categories.index');
    }

    public function edit(StoryCategory $storyCategory)
    {
        abort_if(Gate::denies('story_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.storyCategories.edit', compact('storyCategory'));
    }

    public function update(UpdateStoryCategoryRequest $request, StoryCategory $storyCategory)
    {
        $storyCategory->update($request->all());

        if ($request->input('photo', false)) {
            if (! $storyCategory->photo || $request->input('photo') !== $storyCategory->photo->file_name) {
                if ($storyCategory->photo) {
                    $storyCategory->photo->delete();
                }
                $storyCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($storyCategory->photo) {
            $storyCategory->photo->delete();
        }

        return redirect()->route('admin.story-categories.index');
    }

    public function show(StoryCategory $storyCategory)
    {
        abort_if(Gate::denies('story_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.storyCategories.show', compact('storyCategory'));
    }

    public function destroy(StoryCategory $storyCategory)
    {
        abort_if(Gate::denies('story_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storyCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyStoryCategoryRequest $request)
    {
        $storyCategories = StoryCategory::find(request('ids'));

        foreach ($storyCategories as $storyCategory) {
            $storyCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('story_category_create') && Gate::denies('story_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new StoryCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
