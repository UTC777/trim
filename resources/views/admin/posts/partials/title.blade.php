<div class="form-group">
    <label class="required" for="title">{{ trans('cruds.post.fields.title') }}</label>
    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', @$post->title) }}" required>
    @if($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
</div>