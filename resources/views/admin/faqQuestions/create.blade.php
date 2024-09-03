@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faqQuestion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.faqQuestion.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('use_html_answer') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="use_html_answer" value="0">
                    <input class="form-check-input" type="checkbox" name="use_html_answer" id="use_html_answer" value="1" {{ old('use_html_answer', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="use_html_answer">{{ trans('cruds.faqQuestion.fields.use_html_answer') }}</label>
                </div>
                @if($errors->has('use_html_answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('use_html_answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.use_html_answer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                <textarea class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question" id="question" required>{{ old('question') }}</textarea>
                @if($errors->has('question'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" id="answer">{!! old('answer') !!}</textarea>
                @if($errors->has('answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="html_answer">{{ trans('cruds.faqQuestion.fields.html_answer') }}</label>
                <textarea class="form-control {{ $errors->has('html_answer') ? 'is-invalid' : '' }}" name="html_answer" id="html_answer">{{ old('html_answer') }}</textarea>
                @if($errors->has('html_answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('html_answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.html_answer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube_video_id_only">{{ trans('cruds.faqQuestion.fields.youtube_video_id_only') }}</label>
                <input class="form-control {{ $errors->has('youtube_video_id_only') ? 'is-invalid' : '' }}" type="text" name="youtube_video_id_only" id="youtube_video_id_only" value="{{ old('youtube_video_id_only', '') }}">
                @if($errors->has('youtube_video_id_only'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_video_id_only') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.youtube_video_id_only_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_button_text">{{ trans('cruds.faqQuestion.fields.video_button_text') }}</label>
                <input class="form-control {{ $errors->has('video_button_text') ? 'is-invalid' : '' }}" type="text" name="video_button_text" id="video_button_text" value="{{ old('video_button_text', 'WATCH VIDEO') }}">
                @if($errors->has('video_button_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_button_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.video_button_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="video_image">{{ trans('cruds.faqQuestion.fields.video_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('video_image') ? 'is-invalid' : '' }}" id="video_image-dropzone">
                </div>
                @if($errors->has('video_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('video_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.video_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="read_more_link">{{ trans('cruds.faqQuestion.fields.read_more_link') }}</label>
                <input class="form-control {{ $errors->has('read_more_link') ? 'is-invalid' : '' }}" type="text" name="read_more_link" id="read_more_link" value="{{ old('read_more_link', '') }}">
                @if($errors->has('read_more_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('read_more_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.read_more_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="read_more_button_text">{{ trans('cruds.faqQuestion.fields.read_more_button_text') }}</label>
                <input class="form-control {{ $errors->has('read_more_button_text') ? 'is-invalid' : '' }}" type="text" name="read_more_button_text" id="read_more_button_text" value="{{ old('read_more_button_text', 'READ MORE') }}">
                @if($errors->has('read_more_button_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('read_more_button_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.read_more_button_text_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
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
                xhr.open('POST', '{{ route('admin.faq-questions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $faqQuestion->id ?? 0 }}');
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
    Dropzone.options.videoImageDropzone = {
    url: '{{ route('admin.faq-questions.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 500,
      height: 300
    },
    success: function (file, response) {
      $('form').find('input[name="video_image"]').remove()
      $('form').append('<input type="hidden" name="video_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="video_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($faqQuestion) && $faqQuestion->video_image)
      var file = {!! json_encode($faqQuestion->video_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="video_image" value="' + file.file_name + '">')
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