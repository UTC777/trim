<div class="row">

    <div class="form-group seo-title col-8 no-rad">
        <label for="meta_title">{{ trans('cruds.staticSeo.fields.meta_title') }}</label>
        <input class="form-control seotitle {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', @$post->staticSeo->meta_title ?? '') }}" target='target1'>
        @if($errors->has('meta_title'))
            <span class="text-danger">{{ $errors->first('meta_title') }}</span>
        @endif
        <span class="help-block">SEO Title Guidelines | between 30-65 charicters</span>
        <span id="target1" class="count float-right"></span>
    </div>
    <div class="form-group seo-description col-10 no-rad">
        <label for="meta_description">{{ trans('cruds.staticSeo.fields.meta_description') }}</label>
        <textarea class="form-control seodescription {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description" target='target2'>{{ old('meta_description', @$post->staticSeo->meta_description ?? '') }}</textarea>
        @if($errors->has('meta_description'))
            <span class="text-danger">{{ $errors->first('meta_description') }}</span>
        @endif
        <span class="help-block">SEO Description Guidelines | between 120-320 charicters | Please do not use html in this content area.</span>
        <span id="target2" class="count float-right"></span>
    </div>

    <div class="form-group seo-title col-8 no-rad">
        <label for="facebook_title">{{ trans('cruds.staticSeo.fields.facebook_title') }}</label>
        <input class="form-control seotitle {{ $errors->has('facebook_title') ? 'is-invalid' : '' }}" type="text" name="facebook_title" id="facebook_title" value="{{ old('facebook_title', @$post->staticSeo->facebook_title ?? '') }}" target="target3">
        @if($errors->has('facebook_title'))
            <span class="text-danger">{{ $errors->first('facebook_title') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.facebook_title_helper') }}</span>
        <span id="target3" class="count float-right"></span>
    </div>
    <div class="form-group seo-description col-10 no-rad">
        <label for="facebook_description">{{ trans('cruds.staticSeo.fields.facebook_description') }}</label>
        <textarea class="form-control seodescription {{ $errors->has('facebook_description') ? 'is-invalid' : '' }}" name="facebook_description" id="facebook_description" target='target4'>{{ old('facebook_description', @$post->staticSeo->facebook_description ?? '') }}</textarea>
        @if($errors->has('facebook_description'))
            <span class="text-danger">{{ $errors->first('facebook_description') }}</span>
        @endif
        <span class="help-block">Please do not use html in this content area.</span>
        <span id="target4" class="count float-right"></span>
    </div>

    <div class="form-group seo-title col-8 no-rad">
        <label for="twitter_title">{{ trans('cruds.staticSeo.fields.twitter_title') }}</label>
        <input class="form-control seotitle {{ $errors->has('twitter_title') ? 'is-invalid' : '' }}" type="text" name="twitter_title" id="twitter_title" value="{{ old('twitter_title', @$post->staticSeo->twitter_title ?? '') }}" target='target5'>
        @if($errors->has('twitter_title'))
            <span class="text-danger">{{ $errors->first('twitter_title') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.twitter_title_helper') }}</span>
        <span id="target5" class="count float-right"></span>
    </div>
    <div class="form-group seo-description col-10 no-rad">
        <label for="twitter_description">{{ trans('cruds.staticSeo.fields.twitter_description') }}</label>
        <textarea class="form-control seodescription {{ $errors->has('twitter_description') ? 'is-invalid' : '' }}" name="twitter_description" id="twitter_description" target="target6">{{ old('twitter_description', @$post->staticSeo->twitter_description ?? '') }}</textarea>
        @if($errors->has('twitter_description'))
            <span class="text-danger">{{ $errors->first('twitter_description') }}</span>
        @endif
        <span class="help-block">Please do not use html in this content area.</span>
        <span id="target6" class="count float-right"></span>
    </div>
	
</div>
