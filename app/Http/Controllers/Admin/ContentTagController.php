<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContentTagRequest;
use App\Http\Requests\StoreContentTagRequest;
use App\Http\Requests\UpdateContentTagRequest;
use App\Models\ContentTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('content_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentTags = ContentTag::all();

        return view('admin.contentTags.index', compact('contentTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentTags.create');
    }

    public function store(StoreContentTagRequest $request)
    {
        $contentTag = ContentTag::create($request->all());

        return redirect()->route('admin.content-tags.index');
    }

    public function storeAjax(Request $request)
    {
        if (Gate::denies('content_tag_create')) {
            return response()->json(['message' => 'Access Denied'], Response::HTTP_FORBIDDEN);
        }
    
        $request->validate([
            'name' => 'required|string|unique:content_tags,name',
        ]);
    
        $tag = ContentTag::create([
            'name' => $request->name,
            // Assuming you have a 'slug' field for tags as well. Adjust as necessary.
            'slug' => \Str::slug($request->name),
        ]);
    
        return response()->json(['id' => $tag->id, 'name' => $tag->name]);
    }

    public function edit(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentTags.edit', compact('contentTag'));
    }

    public function update(UpdateContentTagRequest $request, ContentTag $contentTag)
    {
        $contentTag->update($request->all());

        return redirect()->route('admin.content-tags.index');
    }

    public function show(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contentTags.show', compact('contentTag'));
    }

    public function destroy(ContentTag $contentTag)
    {
        abort_if(Gate::denies('content_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentTagRequest $request)
    {
        $contentTags = ContentTag::find(request('ids'));

        foreach ($contentTags as $contentTag) {
            $contentTag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
