<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySuccessStoryRequest;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Models\Service;
use App\Models\SuccessStory;
use App\Models\StoryCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SuccessStoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('success_story_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SuccessStory::with(['services_useds'])->select(sprintf('%s.*', (new SuccessStory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'success_story_show';
                $editGate      = 'success_story_edit';
                $deleteGate    = 'success_story_delete';
                $crudRoutePart = 'success-stories';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('story_about', function ($row) {
                return $row->story_about ? $row->story_about : '';
            });
            $table->editColumn('combined', function ($row) {
                if ($photo = $row->combined) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('services_used', function ($row) {
                $labels = [];
                foreach ($row->services_useds as $services_used) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $services_used->title);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'combined', 'services_used']);

            return $table->make(true);
        }

        return view('admin.successStories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('success_story_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services_useds = Service::pluck('title', 'id');
        $story_categories = StoryCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');;

        return view('admin.successStories.create', compact('services_useds','story_categories'));
    }

    public function store(StoreSuccessStoryRequest $request)
    {
        $successStory = SuccessStory::create($request->all());
        $successStory->services_useds()->sync($request->input('services_useds', []));
        if ($request->input('before', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('before'))))->toMediaCollection('before');
        }

        if ($request->input('after', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('after'))))->toMediaCollection('after');
        }

        if ($request->input('combined', false)) {
            $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('combined'))))->toMediaCollection('combined');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $successStory->id]);
        }

        return redirect()->route('admin.success-stories.index');
    }

    public function edit(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services_useds = Service::pluck('title', 'id');
        $story_categories = StoryCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');;

        $successStory->load('services_useds');

        return view('admin.successStories.edit', compact('services_useds', 'successStory','story_categories'));
    }

    public function update(UpdateSuccessStoryRequest $request, SuccessStory $successStory)
    {
        $successStory->update($request->all());
        $successStory->services_useds()->sync($request->input('services_useds', []));
        if ($request->input('before', false)) {
            if (! $successStory->before || $request->input('before') !== $successStory->before->file_name) {
                if ($successStory->before) {
                    $successStory->before->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('before'))))->toMediaCollection('before');
            }
        } elseif ($successStory->before) {
            $successStory->before->delete();
        }

        if ($request->input('after', false)) {
            if (! $successStory->after || $request->input('after') !== $successStory->after->file_name) {
                if ($successStory->after) {
                    $successStory->after->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('after'))))->toMediaCollection('after');
            }
        } elseif ($successStory->after) {
            $successStory->after->delete();
        }

        if ($request->input('combined', false)) {
            if (! $successStory->combined || $request->input('combined') !== $successStory->combined->file_name) {
                if ($successStory->combined) {
                    $successStory->combined->delete();
                }
                $successStory->addMedia(storage_path('tmp/uploads/' . basename($request->input('combined'))))->toMediaCollection('combined');
            }
        } elseif ($successStory->combined) {
            $successStory->combined->delete();
        }

        return redirect()->route('admin.success-stories.index');
    }

    public function show(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStory->load('services_useds');

        return view('admin.successStories.show', compact('successStory'));
    }

    public function destroy(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStory->delete();

        return back();
    }

    public function massDestroy(MassDestroySuccessStoryRequest $request)
    {
        $successStories = SuccessStory::find(request('ids'));

        foreach ($successStories as $successStory) {
            $successStory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('success_story_create') && Gate::denies('success_story_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SuccessStory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
