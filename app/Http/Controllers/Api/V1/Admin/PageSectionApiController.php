<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Http\Resources\Admin\PageSectionResource;
use App\Models\PageSection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageSectionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('page_section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PageSectionResource(PageSection::all());
    }

    public function store(StorePageSectionRequest $request)
    {
        $pageSection = PageSection::create($request->all());

        return (new PageSectionResource($pageSection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PageSectionResource($pageSection);
    }

    public function update(UpdatePageSectionRequest $request, PageSection $pageSection)
    {
        $pageSection->update($request->all());

        return (new PageSectionResource($pageSection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PageSection $pageSection)
    {
        abort_if(Gate::denies('page_section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageSection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
