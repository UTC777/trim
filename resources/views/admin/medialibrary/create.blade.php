@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/css/mediaLibrary/drag-drop.css') }}" />
@endsection

@section('content')



<div class="card">
    <div class="card-header">
        {{ trans('cruds.media_library.title_singular') }} Upload
    </div>
    <div class="card-body">
        <div class="media-upload-form-wrap" id="async-upload-wrap">
            <form enctype="multipart/form-data" method="post" action="{{ route("admin.media.store") }}" id="media-upload-form">
                <div class="upload-console-drop" id="drop-zone">
                    <h3>Drop Files Here</h3>
                    <span>OR</span>
                    <input type="file" name="files[]" id="standard-upload-files" multiple="multiple" />
                    <input type="hidden" name="action" value="async_upload" />
                    <input type="hidden" name="type" value="normal" id="type-upload-files" />
                    <button type="button" class="btn" id="plupload-browse-button" />Select Files</button>
                    <div class="maximum_upload_file_size">Maximum upload file size: 100MB</div>
                    <div class="bar hidden" id="bar">
                        <div class="bar-fill" id="bar-fill">
                            <div class="bar-fill-text" id="bar-fill-text"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="media-items"><div class="media-attachments"></div></div>

@endsection
@section('scripts')
@parent

<script type="text/javascript">
    var pageload = 1;
    var media_upload_url = '{{ route("admin.media.medialibrary") }}';
    var ajaxRequests = [];
    var admin_media_upload_url = '{{ route("admin.media.mediaaction") }}';
    var admin_ajax_url = '{{ route("admin.media.store") }}';
</script>
<script type="text/javascript" src="{{ asset('admin/js/mediaLibrary/drag-drop.js') }}"></script>
@endsection
