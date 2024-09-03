<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CodeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTablesEditor;
use Yajra\DataTables\Facades\DataTables;

class MediaLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('media_library_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medias = Media::whereNotIn('mime_type', ['application/pdf', 'application/zip', 'application/x-dosexec', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])->orderBy('id', 'DESC')->paginate(30);

        return view('admin.medialibrary.index', compact('medias'));
    }

    public function index_medialibrary()
    {
        $medias = Media::whereNotIn('mime_type', ['application/pdf', 'application/zip', 'application/x-dosexec', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])->orderBy('id', 'DESC')
            ->paginate(30);

        return view('admin.medialibrary.index_medialibrary', compact('medias'));
    }

    public function mediaaction(Request $request)
    {
        if ($request->has('action') and $request->get('action') == 'handler') {
            $send_id = $request->get('id');
            $attachments = Media::where('id', $send_id)->first();
            $mimes = $attachments->mime_type;
            $file['title'] = $attachments->name;
            $file['mimes'] = $mimes;
            $file['fileid'] = $send_id;
            $file['filetype'] = 'image';
            $file['file'] = $attachments->getUrl();
            $file['thumbnail'] = $attachments->getUrl();

            return response()->json($file);
        } elseif ($request->has('action') and $request->get('action') == 'loadmedia') {
            return $this->ajax_load_media($request);
        }
    }

    public function ajax_load_media($request)
    {
        $filter_search = $request->get('search');
        $page = $request->get('page');

        $attachments = Media::where('name', 'like', '%'.$filter_search.'%')
        ->whereNotIn('mime_type', ['application/pdf', 'application/zip', 'application/x-dosexec', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
        ->orderBy('id', 'desc')
        ->paginate(30, '*', '', $page);

        if ($page <= $attachments->lastPage()) {
            $data['upfiles'] = $attachments;
            $returnHTML = view('admin.medialibrary.ajax_loop_load_media', $data)->render();

            return response()->json(['success' => true, 'html'=> $returnHTML, 'lastPage'=> $attachments->lastPage(), 'page'=> $page]);
        } else {
            return response()->json(['success' => false, 'lastPage'=> $attachments->lastPage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.medialibrary.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->has('action') and $request->get('action') == 'async_upload') {
            $retype = ($request->has('retype')) ? $request->get('retype') : '';

            $model = new CodeMedia();
            $model->id = $request->input('crud_id', 0);
            $model->exists = true;

            $media = [];

            if ($images = $request->file('files')) {
                foreach ($images as $image) {
                    $media[] = $model->addMedia($image)->toMediaCollection('media', 'public');
                }
            }

            echo response()->json(['success' => true, 'html'=> '']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        if ($request->id) {
            $media = Media::where('id', $request->id)->first();
        } else {
            $media = Media::where('uuid', $request->uuid)->first();
        }

        if ($media) {
            $media->delete();
        }

        echo 1;
    }
}
