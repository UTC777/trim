<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MediaApiController extends Controller
{
    use MediaUploadingTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = Media::whereNotIn('mime_type', ['application/pdf', 'application/zip', 'application/x-dosexec', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])->orderBy('id', 'DESC')->get();

        $photos = [];

        foreach ($medias as $key => $media) {
            $photos[$key]['thumb'] = $media->getUrl();
            $photos[$key]['url'] = $media->getUrl();
            $photos[$key]['id'] = $media->id;
            $photos[$key]['alt'] = $media->name;
            $photos[$key]['caption'] = $media->name;
            $photos[$key]['title'] = $media->name;
        }

        return json_encode($photos);
    }

    public function files()
    {
        $medias = Media::whereIn('mime_type', ['application/pdf', 'application/zip', 'application/x-dosexec', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])->orderBy('id', 'DESC')->get();

        $files = [];

        foreach ($medias as $key => $media) {
            $files[$key]['url'] = $media->getUrl();
            $files[$key]['id'] = $media->id;
            $files[$key]['name'] = $media->file_name;
            $files[$key]['title'] = $media->name;
            $files[$key]['size'] = $media->human_readable_size;
        }

        return json_encode($files);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
