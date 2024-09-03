<div class="form-group">
    <label for="featured_image">{{ trans('cruds.post.fields.featured_image') }}</label>
    <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
    </div>
    @if($errors->has('featured_image'))
        <div class="invalid-feedback">
            {{ $errors->first('featured_image') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.featured_image_helper') }}</span>
</div>