<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSuccessStoryRequest;
use App\Http\Requests\UpdateSuccessStoryRequest;
use App\Http\Resources\Admin\SuccessStoryResource;
use App\Models\SuccessStory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuccessStoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('success_story_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuccessStoryResource(SuccessStory::with(['services_useds'])->get());
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

        return (new SuccessStoryResource($successStory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SuccessStoryResource($successStory->load(['services_useds']));
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

        return (new SuccessStoryResource($successStory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SuccessStory $successStory)
    {
        abort_if(Gate::denies('success_story_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $successStory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
