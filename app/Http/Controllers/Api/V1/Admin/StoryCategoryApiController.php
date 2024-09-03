<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStoryCategoryRequest;
use App\Http\Requests\UpdateStoryCategoryRequest;
use App\Http\Resources\Admin\StoryCategoryResource;
use App\Models\StoryCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoryCategoryApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('story_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StoryCategoryResource(StoryCategory::all());
    }

    public function store(StoreStoryCategoryRequest $request)
    {
        $storyCategory = StoryCategory::create($request->all());

        if ($request->input('photo', false)) {
            $storyCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new StoryCategoryResource($storyCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StoryCategory $storyCategory)
    {
        abort_if(Gate::denies('story_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StoryCategoryResource($storyCategory);
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

        return (new StoryCategoryResource($storyCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StoryCategory $storyCategory)
    {
        abort_if(Gate::denies('story_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $storyCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
