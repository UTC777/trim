


<div class="form-row">
    <div class="col">
        <div class="form-group">
            <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                <input type="hidden" name="published" value="0">
                @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $contentPage->published || old('published', 0) === 1 ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                @endif

                <label class="form-check-label" for="published">{{ trans('cruds.contentPage.fields.published') }}</label>
            </div>
            @if($errors->has('published'))
                <span class="text-danger">{{ $errors->first('published') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.published_helper') }}</span>
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            <div class="form-check {{ $errors->has('add_to_sitemap') ? 'is-invalid' : '' }}">
                <input type="hidden" name="add_to_sitemap" value="0">
                @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="add_to_sitemap" id="add_to_sitemap" value="1" {{ $contentPage->add_to_sitemap || old('add_to_sitemap', 0) === 1 ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" type="checkbox" name="add_to_sitemap" id="add_to_sitemap" value="1" {{ old('add_to_sitemap', 0) == 1 || old('add_to_sitemap') === null ? 'checked' : '' }}>
                @endif

                <label class="form-check-label" for="add_to_sitemap">{{ trans('cruds.contentPage.fields.add_to_sitemap') }}</label>
            </div>
            @if($errors->has('add_to_sitemap'))
                <span class="text-danger">{{ $errors->first('add_to_sitemap') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.add_to_sitemap_helper') }}</span>
        </div>
    </div>





    <div class="form-group col">
        <div class="form-check {{ $errors->has('is_homepage') ? 'is-invalid' : '' }}">
            <input type="hidden" name="is_homepage" value="0">
            @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="is_homepage" id="is_homepage" value="1" {{ $contentPage->is_homepage || old('is_homepage', 0) === 1 ? 'checked' : '' }}>
            @else
                <input class="form-check-input" type="checkbox" name="is_homepage" id="is_homepage" value="1">
            @endif

            <label class="form-check-label" for="is_homepage">{{ trans('cruds.contentPage.fields.is_homepage') }}</label>
        </div>
        @if($errors->has('is_homepage'))
            <span class="text-danger">{{ $errors->first('is_homepage') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentPage.fields.is_homepage_helper') }}</span>
    </div>

</div>

{{-- @include('admin.contentPages.partials.path') --}}

<div class="form-group">
    <label for="custom_css">{{ trans('cruds.contentPage.fields.custom_css') }}</label>
    <textarea class="prism-live language-css" name="custom_css" id="custom_css">{{ old('custom_css', @$contentPage->custom_css) }}</textarea>
</div>
