<div class="form-group">
    <label for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
    <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
    </div>
    @if($errors->has('featured_image'))
        <span class="text-danger">{{ $errors->first('featured_image') }}</span>
    @endif
    <span class="help-block">This is the page masthead. 1200x500</span>
</div>


<div class="form-group">
    <label for="photos">{{ trans('cruds.contentPage.fields.photos') }}</label>
    <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
    </div>
    @if($errors->has('photos'))
        <span class="text-danger">{{ $errors->first('photos') }}</span>
    @endif
    <span class="help-block">Root Path: site/img/landing-pages/ | {{ trans('cruds.contentPage.fields.photos_helper') }}</span>
</div>


<div class="form-group">
    <label for="attachments">{{ trans('cruds.contentPage.fields.attachments') }}</label>
    <div class="needsclick dropzone {{ $errors->has('attachments') ? 'is-invalid' : '' }}" id="attachments-dropzone">
    </div>
    @if($errors->has('attachments'))
        <span class="text-danger">{{ $errors->first('attachments') }}</span>
    @endif
    <span class="help-block">Root Path: site/attachments/landing-pages/ | {{ trans('cruds.contentPage.fields.attachments_helper') }}</span>
</div>

 