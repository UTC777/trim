@extends('layouts.admin')

@section('styles')
    <style>
        .bg-dark { background-color: #343a40; padding: 1rem; }
        .d-flex { display: flex; }
        .flex-wrap { flex-wrap: wrap; }
        .align-items-center { align-items: center; }
        .form-check-inline { display: flex; align-items: center; margin-bottom: 0; }
        .mx-2 { margin-right: 0.5rem; margin-left: 0.5rem; }
        .mt-2 { margin-top: 0.5rem; }
        .text-light { color: #f8f9fa; }
        .is-invalid { border-color: #dc3545; }
        .text-danger { color: #dc3545; }
        .help-block { display: block; margin-top: 0.25rem; }
    </style>
@endsection

@section('content')


<div class="card direct-chat direct-chat-primary" style="position: relative; left: 0px; top: 0px;">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
      <h3 class="card-title">SERP Previews</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: block;">

        <div id="serp-preview-div" class="show">
            @include('admin.staticSeos.partials.serp-preview')
        </div>

    </div>
    <!-- /.card-body -->

  </div>

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.staticSeo.title_singular') }}
    </div>

    <div class="card-body">
        <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
        </div>
        <form method="POST" action="{{ route("admin.static-seos.update", [$staticSeo->id]) }}" enctype="multipart/form-data" id="submitPostForm">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $staticSeo->id }}">

            @include('admin.staticSeos.partials.top')
            @include('admin.staticSeos.partials.landing-page')
            @include('admin.staticSeos.partials.seo-image')
            @include('admin.staticSeos.partials.post')
            @include('admin.staticSeos.partials.product')

            @include('admin.staticSeos.partials.seo-meta')

            <div class="row">
				@include('admin.staticSeos.partials.microdata')
	            @include('admin.staticSeos.partials.jsonld')

			</div>
                @include('admin.staticSeos.partials.seo-class')

                <div class="form-group">
                    <label id="errorMsg" class="error" for="title"></label> <hr>
                    <button class="btn btn-success saveContent" type="button" id="save" bType="save">
                      {{ trans('global.save') }}
                    </button>
                    <button class="btn btn-primary saveContent" id="save-and-preview" type="button" bType="preview">
                      {{ trans('global.save_and_preview') }}
                    </button>
                    <button class="btn btn-danger" type="submit">
                      {{ trans('global.save_and_close') }}
                  </button>
                  </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
    $('textarea#json_ld_tag').each(function () {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function () {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

$('.saveContent').click(function(){

var bType=$(this).attr('bType');

$('#submitPostForm').validate({
    rules: {
      'meta_title': {
          required: true
      },
    },
    messages: {
      title: "Please Enter Meta Title",
  }
});

if ($('#submitPostForm').valid()) // check if form is valid
{
    $this=$(this);
    $loader='<div class="spinner-border text-dark" role="status">'+
              '<span class="sr-only">Loading...</span>'+
              '</div>';
    $this.html($loader);
    var formData = $('#submitPostForm').serializeArray();

    formData.push({name: "preview", value: 1});

    $.ajax({
        type: 'POST',
        url: '{{ route("admin.static-seos.update", [$staticSeo->id]) }}',
        dataType: 'json',
        data: formData,
        success: function(resultData) {

          if (resultData.error && resultData.error.length>0) {
            printErrorMsg(resultData.error);
            if (bType=='save') {
                    $this.html("{{ trans('global.save') }}");
            }else{
              $this.html("{{ trans('global.save_and_preview') }}");
            }
          } else {
            $(".print-error-msg").css('display','none');
            if (bType=='save') {
                    $this.html("{{ trans('global.save') }}");
            }else{
              $this.html("{{ trans('global.save_and_preview') }}");
              window.open(resultData, '_blank');
            }
          }

        }
    });

}

});

    Dropzone.options.seoImageDropzone = {
    url: '{{ route('admin.static-seos.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="seo_image"]').remove()
      $('form').append('<input type="hidden" name="seo_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="seo_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($staticSeo) && $staticSeo->seo_image)
      var file = {!! json_encode($staticSeo->seo_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="seo_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection
