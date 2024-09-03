@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.update", [$setting->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="facebook_link">{{ trans('cruds.setting.fields.facebook_link') }}</label>
                <input class="form-control {{ $errors->has('facebook_link') ? 'is-invalid' : '' }}" type="text" name="facebook_link" id="facebook_link" value="{{ old('facebook_link', $setting->facebook_link) }}">
                @if($errors->has('facebook_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.facebook_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter_link">{{ trans('cruds.setting.fields.twitter_link') }}</label>
                <input class="form-control {{ $errors->has('twitter_link') ? 'is-invalid' : '' }}" type="text" name="twitter_link" id="twitter_link" value="{{ old('twitter_link', $setting->twitter_link) }}">
                @if($errors->has('twitter_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.twitter_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube_link">{{ trans('cruds.setting.fields.youtube_link') }}</label>
                <input class="form-control {{ $errors->has('youtube_link') ? 'is-invalid' : '' }}" type="text" name="youtube_link" id="youtube_link" value="{{ old('youtube_link', $setting->youtube_link) }}">
                @if($errors->has('youtube_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('youtube_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.youtube_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instagram">{{ trans('cruds.setting.fields.instagram') }}</label>
                <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $setting->instagram) }}">
                @if($errors->has('instagram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.instagram_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="github">{{ trans('cruds.setting.fields.github') }}</label>
                <input class="form-control {{ $errors->has('github') ? 'is-invalid' : '' }}" type="text" name="github" id="github" value="{{ old('github', $setting->github) }}">
                @if($errors->has('github'))
                    <div class="invalid-feedback">
                        {{ $errors->first('github') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.github_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="avatar">{{ trans('cruds.setting.fields.avatar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('avatar') ? 'is-invalid' : '' }}" id="avatar-dropzone">
                </div>
                @if($errors->has('avatar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('avatar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.avatar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_bio">{{ trans('cruds.setting.fields.short_bio') }}</label>
                <textarea class="form-control {{ $errors->has('short_bio') ? 'is-invalid' : '' }}" name="short_bio" id="short_bio">{{ old('short_bio', $setting->short_bio) }}</textarea>
                @if($errors->has('short_bio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_bio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.short_bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.setting.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}">
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.setting.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', @$setting->email) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.setting.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $setting->address) }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="opening_hours">{{ trans('cruds.setting.fields.opening_hours') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('opening_hours') ? 'is-invalid' : '' }}" name="opening_hours" id="opening_hours">
                @if ($setting->opening_hours)
                    {!! $setting->opening_hours !!}
                @else
                    <li>
                        Monday: 8:00 AM - 8:00 PM
                    </li>
                    <li>
                        Saturday: 10:00 AM - 8:00 PM
                    </li>
                    <li>
                        Sunday: Closed
                    </li>
                @endif
                </textarea>
                @if($errors->has('opening_hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('opening_hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.opening_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="google_map_link">{{ trans('cruds.setting.fields.google_map_link') }}</label>
                <input class="form-control {{ $errors->has('google_map_link') ? 'is-invalid' : '' }}" type="text" name="google_map_link" id="google_map_link" value="{{ old('google_map_link', $setting->google_map_link) }}">
                @if($errors->has('google_map_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('google_map_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.google_map_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.setting.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $setting->city) }}">
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="state">{{ trans('cruds.setting.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $setting->state) }}">
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zipcode">{{ trans('cruds.setting.fields.zipcode') }}</label>
                <input class="form-control {{ $errors->has('zipcode') ? 'is-invalid' : '' }}" type="text" name="zipcode" id="zipcode" value="{{ old('zipcode', $setting->zipcode) }}">
                @if($errors->has('zipcode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zipcode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.zipcode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="long_bio">{{ trans('cruds.setting.fields.long_bio') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('long_bio') ? 'is-invalid' : '' }}" name="long_bio" id="long_bio">{!! old('long_bio', $setting->long_bio) !!}</textarea>
                @if($errors->has('long_bio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('long_bio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.long_bio_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_social_link">{{ trans('cruds.setting.fields.additional_social_link') }}</label>
                <input class="form-control {{ $errors->has('additional_social_link') ? 'is-invalid' : '' }}" type="text" name="additional_social_link" id="additional_social_link" value="{{ old('additional_social_link', $setting->additional_social_link) }}">
                @if($errors->has('additional_social_link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_social_link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.additional_social_link_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_social_link_icon">{{ trans('cruds.setting.fields.additional_social_link_icon') }}</label>
                <input class="form-control {{ $errors->has('additional_social_link_icon') ? 'is-invalid' : '' }}" type="text" name="additional_social_link_icon" id="additional_social_link_icon" value="{{ old('additional_social_link_icon', $setting->additional_social_link_icon) }}">
                @if($errors->has('additional_social_link_icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_social_link_icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.additional_social_link_icon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_social_link_2">{{ trans('cruds.setting.fields.additional_social_link_2') }}</label>
                <input class="form-control {{ $errors->has('additional_social_link_2') ? 'is-invalid' : '' }}" type="text" name="additional_social_link_2" id="additional_social_link_2" value="{{ old('additional_social_link_2', $setting->additional_social_link_2) }}">
                @if($errors->has('additional_social_link_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_social_link_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.additional_social_link_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="additional_social_link_icon_2">{{ trans('cruds.setting.fields.additional_social_link_icon_2') }}</label>
                <input class="form-control {{ $errors->has('additional_social_link_icon_2') ? 'is-invalid' : '' }}" type="text" name="additional_social_link_icon_2" id="additional_social_link_icon_2" value="{{ old('additional_social_link_icon_2', $setting->additional_social_link_icon_2) }}">
                @if($errors->has('additional_social_link_icon_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('additional_social_link_icon_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.additional_social_link_icon_2_helper') }}</span>
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
    Dropzone.options.avatarDropzone = {
    url: '{{ route('admin.settings.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 600,
      height: 600
    },
    success: function (file, response) {
      $('form').find('input[name="avatar"]').remove()
      $('form').append('<input type="hidden" name="avatar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="avatar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($setting) && $setting->avatar)
      var file = {!! json_encode($setting->avatar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="avatar" value="' + file.file_name + '">')
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
                xhr.open('POST', '{{ route('admin.settings.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $setting->id ?? 0 }}');
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

@endsection