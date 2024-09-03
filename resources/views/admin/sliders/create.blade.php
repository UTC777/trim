@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sliders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.slider.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slider_name">{{ trans('cruds.slider.fields.slider_name') }}</label>
                <input class="form-control {{ $errors->has('slider_name') ? 'is-invalid' : '' }}" type="text" name="slider_name" id="slider_name" value="{{ old('slider_name', '') }}">
                @if($errors->has('slider_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slider_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.slider_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.slider.fields.location') }}</label>
                <select class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location">
                    <option value disabled {{ old('location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Slider::LOCATION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('location', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.slider.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_title">{{ trans('cruds.slider.fields.sub_title') }}</label>
                <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', '') }}">
                @if($errors->has('sub_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sub_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.sub_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_title">{{ trans('cruds.slider.fields.main_title') }}</label>
                <input class="form-control {{ $errors->has('main_title') ? 'is-invalid' : '' }}" type="text" name="main_title" id="main_title" value="{{ old('main_title', '') }}">
                @if($errors->has('main_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.main_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sub_title_2">{{ trans('cruds.slider.fields.sub_title_2') }}</label>
                <input class="form-control {{ $errors->has('sub_title_2') ? 'is-invalid' : '' }}" type="text" name="sub_title_2" id="sub_title_2" value="{{ old('sub_title_2', '') }}">
                @if($errors->has('sub_title_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sub_title_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.sub_title_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slider_description">{{ trans('cruds.slider.fields.slider_description') }}</label>
                <input class="form-control {{ $errors->has('slider_description') ? 'is-invalid' : '' }}" type="text" name="slider_description" id="slider_description" value="{{ old('slider_description', '') }}">
                @if($errors->has('slider_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slider_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.slider_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text_heading">{{ trans('cruds.slider.fields.text_heading') }}</label>
                <input class="form-control {{ $errors->has('text_heading') ? 'is-invalid' : '' }}" type="text" name="text_heading" id="text_heading" value="{{ old('text_heading', '') }}">
                @if($errors->has('text_heading'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_heading') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.text_heading_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading_1">{{ trans('cruds.slider.fields.heading_1') }}</label>
                <input class="form-control {{ $errors->has('heading_1') ? 'is-invalid' : '' }}" type="text" name="heading_1" id="heading_1" value="{{ old('heading_1', '') }}">
                @if($errors->has('heading_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('heading_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.heading_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading_2">{{ trans('cruds.slider.fields.heading_2') }}</label>
                <input class="form-control {{ $errors->has('heading_2') ? 'is-invalid' : '' }}" type="text" name="heading_2" id="heading_2" value="{{ old('heading_2', '') }}">
                @if($errors->has('heading_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('heading_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.heading_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="heading_3">{{ trans('cruds.slider.fields.heading_3') }}</label>
                <input class="form-control {{ $errors->has('heading_3') ? 'is-invalid' : '' }}" type="text" name="heading_3" id="heading_3" value="{{ old('heading_3', '') }}">
                @if($errors->has('heading_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('heading_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.heading_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text">{{ trans('cruds.slider.fields.text') }}</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', '') }}">
                @if($errors->has('text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_button_text">{{ trans('cruds.slider.fields.main_button_text') }}</label>
                <input class="form-control {{ $errors->has('main_button_text') ? 'is-invalid' : '' }}" type="text" name="main_button_text" id="main_button_text" value="{{ old('main_button_text', '') }}">
                @if($errors->has('main_button_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_button_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.main_button_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_button_link">{{ trans('cruds.slider.fields.main_button_link') }}</label>
                <input class="form-control {{ $errors->has('main_button_link') ? 'is-invalid' : '' }}" type="text" name="main_button_link" id="main_button_link" value="{{ old('main_button_link', '') }}">
                @if($errors->has('main_button_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_button_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.main_button_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="main_button_tab_index">{{ trans('cruds.slider.fields.main_button_tab_index') }}</label>
                <input class="form-control {{ $errors->has('main_button_tab_index') ? 'is-invalid' : '' }}" type="number" name="main_button_tab_index" id="main_button_tab_index" value="{{ old('main_button_tab_index', '1') }}" step="1">
                @if($errors->has('main_button_tab_index'))
                    <div class="invalid-feedback">
                        {{ $errors->first('main_button_tab_index') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.main_button_tab_index_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="second_button_text">{{ trans('cruds.slider.fields.second_button_text') }}</label>
                <input class="form-control {{ $errors->has('second_button_text') ? 'is-invalid' : '' }}" type="text" name="second_button_text" id="second_button_text" value="{{ old('second_button_text', '') }}">
                @if($errors->has('second_button_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('second_button_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.second_button_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="second_button_link">{{ trans('cruds.slider.fields.second_button_link') }}</label>
                <input class="form-control {{ $errors->has('second_button_link') ? 'is-invalid' : '' }}" type="text" name="second_button_link" id="second_button_link" value="{{ old('second_button_link', '') }}">
                @if($errors->has('second_button_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('second_button_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.second_button_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="second_button_tab_index">{{ trans('cruds.slider.fields.second_button_tab_index') }}</label>
                <input class="form-control {{ $errors->has('second_button_tab_index') ? 'is-invalid' : '' }}" type="number" name="second_button_tab_index" id="second_button_tab_index" value="{{ old('second_button_tab_index', '2') }}" step="1">
                @if($errors->has('second_button_tab_index'))
                    <div class="invalid-feedback">
                        {{ $errors->first('second_button_tab_index') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.second_button_tab_index_helper') }}</span>
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
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 2000,
      height: 900
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($slider) && $slider->image)
      var file = {!! json_encode($slider->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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
