<div id="seo-row" class="row">
	<div id="metabox" class="col-md-4">
		<div class="form-group seo-title col-12">
			<label for="meta_title">{{ trans('cruds.staticSeo.fields.meta_title') }}</label>
			<input class="form-control seotitle {{ $errors->has('meta_title') ? 'is-invalid' : '' }}" type="text" name="seo[meta_title]" id="meta_title" value="{{ old('meta_title', @$staticSeo->meta_title) }}">
			@if($errors->has('meta_title'))
				<span class="text-danger">{{ $errors->first('meta_title') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.meta_title_helper') }}</span>
		</div>
		<div class="form-group seo-description col-12">
			<label for="meta_description">{{ trans('cruds.staticSeo.fields.meta_description') }}</label>
			<textarea class="form-control seodescription {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="seo[meta_description]" id="meta_description">{{ old('meta_description', $staticSeo->meta_description) }}</textarea>
			@if($errors->has('meta_description'))
				<span class="text-danger">{{ $errors->first('meta_description') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.meta_description_helper') }}</span>
		</div>
	</div>
	<div id="facebookbox" class="col-md-4">
		<div class="form-group seo-title col-12">
			<label for="facebook_title">{{ trans('cruds.staticSeo.fields.facebook_title') }}</label>
			<input class="form-control seotitle {{ $errors->has('facebook_title') ? 'is-invalid' : '' }}" type="text" name="seo[facebook_title]" id="facebook_title" value="{{ old('facebook_title', @$staticSeo->facebook_title) }}">
			@if($errors->has('facebook_title'))
				<span class="text-danger">{{ $errors->first('facebook_title') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.facebook_title_helper') }}</span>
		</div>
		<div class="form-group seo-description col-12">
			<label for="facebook_description">{{ trans('cruds.staticSeo.fields.facebook_description') }}</label>
			<textarea class="form-control seodescription {{ $errors->has('facebook_description') ? 'is-invalid' : '' }}" name="seo[facebook_description]" id="facebook_description">{{ old('facebook_description', $staticSeo->facebook_description) }}</textarea>
			@if($errors->has('facebook_description'))
				<span class="text-danger">{{ $errors->first('facebook_description') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.facebook_description_helper') }}</span>
		</div>
	</div>
	<div id="twitterbox" class="col-md-4">
		<div class="form-group seo-title col-12">
			<label for="twitter_title">{{ trans('cruds.staticSeo.fields.twitter_title') }}</label>
			<input class="form-control seotitle {{ $errors->has('twitter_title') ? 'is-invalid' : '' }}" type="text" name="seo[twitter_title]" id="twitter_title" value="{{ old('twitter_title', @$staticSeo->twitter_title) }}">
			@if($errors->has('twitter_title'))
				<span class="text-danger">{{ $errors->first('twitter_title') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.twitter_title_helper') }}</span>
		</div>
		<div class="form-group seo-description col-12">
			<label for="twitter_description">{{ trans('cruds.staticSeo.fields.twitter_description') }}</label>
			<textarea class="form-control seodescription {{ $errors->has('twitter_description') ? 'is-invalid' : '' }}" name="seo[twitter_description]" id="twitter_description">{{ old('twitter_description', $staticSeo->twitter_description) }}</textarea>
			@if($errors->has('twitter_description'))
				<span class="text-danger">{{ $errors->first('twitter_description') }}</span>
			@endif
			<span class="help-block">{{ trans('cruds.staticSeo.fields.twitter_description_helper') }}</span>
		</div>
	</div>
</div>
