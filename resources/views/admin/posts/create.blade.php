@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.post.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.posts.store") }}" enctype="multipart/form-data">
            @csrf
           
            <div class="row">
              <div class="col-7 col-sm-9">
                @include('admin.posts.partials.title')
                @include('admin.posts.partials.path')
                <hr>
                  <div class="tab-content" id="vert-tabs-right-tabContent">
                      <div class="tab-pane fade show active" id="vert-tabs-right-general" role="tabpanel" aria-labelledby="vert-tabs-right-general-tab">
                          @include('admin.posts.partials.general')
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-right-images"    role="tabpanel" aria-labelledby="vert-tabs-right-images-tab">
                          @include('admin.posts.partials.images')
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-right-seo"      role="tabpanel" aria-labelledby="vert-tabs-right-seo-tab">
                        @include('admin.posts.partials.seo-meta')
                      </div>
                      <div class="tab-pane fade" id="vert-tabs-right-settings" role="tabpanel" aria-labelledby="vert-tabs-right-settings-tab">
                        @include('admin.posts.partials.settings')
                    </div>                     
                    
                  </div>
              </div>
          
              <div class="col-5 col-sm-3">
                  <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
          
                      <a class="nav-link" id="vert-tabs-right-settings-tab" data-toggle="pill" href="#vert-tabs-right-settings" role="tab" aria-controls="vert-tabs-right-settings" aria-selected="false">DETAILS</a>
                      <a class="nav-link active" id="vert-tabs-right-general-tab" data-toggle="pill" href="#vert-tabs-right-general" role="tab" aria-controls="vert-tabs-right-general" aria-selected="true">PAGE CONTENT</a>
                       <a class="nav-link" id="vert-tabs-right-images-tab" data-toggle="pill" href="#vert-tabs-right-images" role="tab" aria-controls="vert-tabs-right-images" aria-selected="true">IMAGES</a>
                      <a class="nav-link" id="vert-tabs-right-seo-tab" data-toggle="pill" href="#vert-tabs-right-seo" role="tab" aria-controls="vert-tabs-right-seo" aria-selected="false">SEO META</a>
                      

                  </div>
              </div>
          
          </div>
          
          
          <hr>
            <div class="form-group">
                <button class="btn btn-info" type="submit">
                    Next
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.posts.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $post->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.posts.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($post) && $post->featured_image)
      var file = {!! json_encode($post->featured_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
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

$(document).ready(function() {
        // Initialize Select2
        $('#categories').select2({             
            width: '100%',  
            tags: true, // Allows the creation of new options on the fly
            createTag: function (params) {
                // This function overrides the default behavior for creating new tags
                // You can add custom logic here if needed, for example, to prevent automatic tag creation
                return null; // Prevents Select2 from automatically creating a new tag
            }
        });

        $('#addCategory').click(function() {
            var categoryName = prompt("Please enter the new category name:");
            if (categoryName) {
                $.ajax({
                    url: '/admin/content-categories/store-ajax',
                    type: 'POST',
                    data: {
                        name: categoryName,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Create a new Option and append it to the Select2 control
                        var newOption = new Option(response.name, response.id, true, true);
                        $('#categories').append(newOption).trigger('change');

                        // Optionally, you can make the new option selected immediately
                        // $('#categories').val(response.id).trigger('change');
                    },
                    error: function(xhr, status, error) {
                        alert("Error adding category: " + error);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        $('#addTag').click(function() {
            var tagName = prompt("Please enter the new tag name:");
            if (tagName) {
                $.ajax({
                    url: '/admin/content-tags/store-ajax', 
                    type: 'POST',
                    data: {
                        name: tagName,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        var newOption = new Option(response.name, response.id, true, true);
                        $('#tags').append(newOption).trigger('change');
                    },
                    error: function(xhr, status, error) {
                        alert("Error adding tag: " + error);
                    }
                });
            }
        });

        $('.select2').select2({
            width: '100%',
            tags: true // Allows the creation of new options on the fly
        });
    });



    $(document).ready(function() {
        function adjustSelect2Width() {
            var select2Width = $('.input-group').width() - $('.input-group-append').outerWidth(true) - 2; // 2px for border
            $('.select2-container--default').css('width', select2Width);
        }

        adjustSelect2Width();
        $(window).resize(adjustSelect2Width);
    });
    
</script>
@endsection