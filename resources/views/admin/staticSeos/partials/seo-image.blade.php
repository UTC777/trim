<div class="form-group col-10">
    <label for="seo_image_url">SEO IMAGE URL</label>
    <input class="form-control {{ $errors->has('seo_image_url') ? 'is-invalid' : '' }}" type="text" name="seo_image_url" id="meta-featured-image" value="{{ old('seo_image_url', @$staticSeo->seo_image_url) }}">
</div>