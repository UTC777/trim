<div class='form-row'>
	<div class="form-group col-md-6 col no-rad">
		<label class="required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
		<input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $contentPage->title ?? '') }}" required>
		@if($errors->has('title'))
			<span class="text-danger">{{ $errors->first('title') }}</span>
		@endif
		<span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
		<div class="valid-feedback">
			Looks good!
		</div>
	</div>

	<div class="form-group col-md-6 col no-rad">
		<label for="sub_title">{{ trans('cruds.contentPage.fields.sub_title') }}</label>
		<input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', $contentPage->sub_title ?? '') }}">
		@if($errors->has('sub_title'))
			<span class="text-danger">{{ $errors->first('sub_title') }}</span>
		@endif
		<span class="help-block">{{ trans('cruds.contentPage.fields.sub_title_helper') }}</span>
		<div class="valid-feedback">
			Looks good!
		</div>
	</div>

</div>
