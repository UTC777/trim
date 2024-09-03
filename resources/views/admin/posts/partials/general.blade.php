<div class="form-group">
    <label for="page_text">{{ trans('cruds.post.fields.page_text') }}</label>
    <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text', @$post->page_text) !!}</textarea>
    @if($errors->has('page_text'))
        <div class="invalid-feedback">
            {{ $errors->first('page_text') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.page_text_helper') }}</span>
</div>