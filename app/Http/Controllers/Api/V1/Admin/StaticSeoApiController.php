<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreStaticSeoRequest;
use App\Http\Requests\UpdateStaticSeoRequest;
use App\Http\Resources\Admin\StaticSeoResource;
use App\Models\StaticSeo;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaticSeoApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('static_seo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaticSeoResource(StaticSeo::all());
    }

    public function store(StoreStaticSeoRequest $request)
    {
        $staticSeo = StaticSeo::create($request->all());

        if ($request->input('seo_image', false)) {
            $staticSeo->addMedia(storage_path('tmp/uploads/' . basename($request->input('seo_image'))))->toMediaCollection('seo_image');
        }

        return (new StaticSeoResource($staticSeo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StaticSeoResource($staticSeo);
    }

    public function update(UpdateStaticSeoRequest $request, StaticSeo $staticSeo)
    {
        $staticSeo->update($request->all());

        if ($request->input('seo_image', false)) {
            if (! $staticSeo->seo_image || $request->input('seo_image') !== $staticSeo->seo_image->file_name) {
                if ($staticSeo->seo_image) {
                    $staticSeo->seo_image->delete();
                }
                $staticSeo->addMedia(storage_path('tmp/uploads/' . basename($request->input('seo_image'))))->toMediaCollection('seo_image');
            }
        } elseif ($staticSeo->seo_image) {
            $staticSeo->seo_image->delete();
        }

        return (new StaticSeoResource($staticSeo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StaticSeo $staticSeo)
    {
        abort_if(Gate::denies('static_seo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staticSeo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
