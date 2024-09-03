<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <title>Media Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/mediaLibrary/media-upload.min.css') }}" />

    <style>
        .attachment-preview .thumbnail-item img {
            width: 100%;
        }
    </style>
</head>
<body class="ltr" id="creative-media-upload">
<div class="creative-media-upload-header">
    <h1>Insert Media</h1>
    <button type="button" class="creative-media-upload-close" onclick="try{top.tb_remove();}catch(e){}; return false;"></button>
    <ul class="creative-media-upload-sidemenu">
        <li><a href="#" data-type="library" class="library current">Media Library</a></li>
    </ul>
</div>
<div class="media-toolbar-search">
    <div class="row">
        <div class="col-md-5">
            <input type="search" placeholder="Search" class="form-control filter-input-search width200">
            <button type="button" class="btn btn-primary btn-media-filter">Filter</button>
        </div>
    </div>
</div>
<div class="creative-media-upload-browser">
    <div class="creative-media-upload-content">
        <div class="content-tab content-library">
            <div id="media-items" class="media-items-library" data-loading="0" data-thelast="0">
                <ul class="media-attachments media-attachments-thickbox">
                    @foreach ($medias as $key => $media)
                    <li class="" role="checkbox" data-id="{{$media->id}}" aria-checked="true" id="attachment-item-{{$media->id}}">
                        <span class="tooltiptextimg" id="myTooltipName{{$media->id}}">{{ $media->file_name }}</span>
                        <div class="check"><div class="media-icon"></div></div>
                        <div class="delete" id="{{$media->id}}" title="Delete"><div class="media-icon"></div></div>
                        <div class="copy-link" link="{{$media->getUrl()}}" id="{{$media->id}}"><span class="tooltiptext" id="myTooltip{{ $media->id }}">Copy to clipboard</span><div class="media-icon"></div></div>
                        <div class="attachment-preview">
                            <div class="thumbnail-item"><img src="{{ $media->getUrl() }}" /></div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div id="media-upload-content-toolbar">
                <div class="row">
                    <div class="col-md-5">
                        <button type="button" data-id="0" class="button button-media-select" disabled="disabled">Use this image</button>
                    </div>
                </div>
            </div>
        </div>    
        
    </div>
</div>

<div class="overlaymodal"></div>

    <script type="text/javascript">
        var pageload = 1;
        var media_upload_url = '{{ route("admin.media.medialibrary") }}',
        tb_pathToImage = "{{ asset('article-editor/libs/cupload/js/thickbox/loadingAnimation.gif') }}",
        tb_closeImage  = "{{ asset('article-editor/libs/cupload/js/thickbox/tb-close.png') }}";
        
        var ajaxRequests = [];
        var admin_media_upload_url = '{{ route("admin.media.mediaaction") }}';
        var admin_ajax_url = '';
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('admin/js/mediaLibrary/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('article-editor/libs/cupload/js/thickbox/thickbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/mediaLibrary/media-upload.min.js') }}"></script>
    <script>
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $(function() {$("table th input:checkbox").on("click" , function(){var that = this;$(this).closest("table").find("tr > td:first-child input:checkbox").each(function(){this.checked = that.checked;$(this).closest("tr").toggleClass("selected");});});})</script>

    <script>
        
    $(document.body).on('click', '.delete' ,function(){

    $this=$(this);
    $body = $("body");
    $body.addClass("loading");

    if (confirm('Are you sure you want to remove?')) {

        var id = $this.attr('id');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:'{{ route("admin.media.delete") }}',
            method:"POST",
            data: {id:id,_token:_token},
            success:function(response) {
            $this.parent('li').remove();
            $body.removeClass("loading");
            }
        })
    }else{
        $body.removeClass("loading");
    }

    });

    $(document.body).on('click', '.copy-link' ,function(){
            var key = $(this).attr('id');
            let str = $(this).attr('link');
            const el = document.createElement('textarea');
            el.value = str;
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            var tooltip = document.getElementById("myTooltip"+key);
            tooltip.innerHTML = "Copied";
        });

        function outFunc(key) {
        var tooltip = document.getElementById("myTooltip"+key);
        tooltip.innerHTML = "Copy to clipboard";
        }
    </script>
</body>
</html>
