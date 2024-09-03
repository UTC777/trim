@php
    $path = $contentPage->path ?? '';
    $path2 = $contentPage->path2 ?? '';
    $path3 = $contentPage->path3 ?? '';
    $path4 = $contentPage->path4 ?? '';
    $slug = $contentPage->slug ?? '';
@endphp

<div class='form-row'>
    <div class="form-group col-md-12 col-lg-11 no-rad" dir="ltr">
        <div class="input-group full-url">

            @if($path  || $slug)
				{{-- TODO: MAKE THIS LINK MATCH PATH SET SO WHEN CLICKED IT GOES TO PREVIEW --}}
                <span class="input-group-text no-br" id="postname-addon">
                    <a target="_blank" href="{{ url($path . '/' . $slug) }}"><i class="fas fa-link"></i></a>
                </span>

				<span class="input-group-text no-br" id="slug-label">{{ url('') }}</span>
				<span class="input-group-text no-br path">/</span>
		        <input class="form-control path {{ $errors->has('path') ? 'is-invalid' : '' }}" type="text" name="path" id="path" value="{{ old('path', @$contentPage->path) }}" placeholder="path">
		        <span class="input-group-text no-br path2">/</span>
		        <input class="form-control path2 {{ $errors->has('path2') ? 'is-invalid' : '' }}" type="text" name="path2" id="path2" value="{{ old('path2', @$contentPage->path2) }}" placeholder="path2">
		        <span class="input-group-text no-br path3">/</span>
				<input class="form-control path3 {{ $errors->has('path3') ? 'is-invalid' : '' }}" type="text" name="path3" id="path3" value="{{ old('path3', @$contentPage->path3) }}" placeholder="path3">
				<span class="input-group-text no-br path4">/</span>
				<input class="form-control path4 {{ $errors->has('path4') ? 'is-invalid' : '' }}" type="text" name="path4" id="path4" value="{{ old('path4', @$contentPage->path4) }}" placeholder="path4">
				<span class="input-group-text no-br">/</span>
					{{-- <input class="no-br col valid" name="slug" value="@if(isset($slug)){{ $slug }}@endif" class="form-control"  aria-describedby="slug" />--}}
		        <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', @$contentPage->slug) }}" placeholder="slug">
            @else

                <span class="input-group-text no-br" id="postname-addon"><i class="fas fa-unlink"></i></span>
				<span class="input-group-text no-br" id="slug-label">{{ url('') }}</span>
				<span class="input-group-text no-br path">/</span>
		        <input name="path" id="path" class="form-control path" placeholder="path" aria-describedby="Path only no domain or /" />
		        <span class="input-group-text no-br path2">/</span>
				<input name="path2" id="path2" class="form-control path2" placeholder="path2" aria-describedby="Path only no domain or /" />
				<span class="input-group-text no-br path3">/</span>
				<input name="path3" id="path3" class="form-control path3" placeholder="path3" aria-describedby="Path only no domain or /" />
				<span class="input-group-text no-br path4">/</span>
				<input name="path4" id="path4" class="form-control path4" placeholder="path4"  aria-describedby="Path only no domain or /" />
				<span class="input-group-text no-br pathslash">/</span>
		        <input name="slug" id="slug" class="form-control"  aria-describedby="Slug" placeholder="slug" />
            @endisset
        </div>
	    <small class="help-block">Path should be one word. | Slugs should be as short as possible without stop words </small>
		<small>You can not add a segment/path for existing content such as posts, faqs, testimonials etc</small>
    </div>
</div>
<div class='form-row'>
    <div class="form-group seo-description col-md-6 no-rad">
        <label for="path-segments">Path Segments:</label>
        <select class='form-control' name="path_segments" id="path-segments">
            <option value="0" @if (@$contentPage->path_segments==0)
            selected
                    @endif>0</option>
            <option value="1" @if (@$contentPage->path_segments==1)
            selected
                    @endif>1</option>
            <option value="2" @if (@$contentPage->path_segments==2)
            selected
                    @endif>2</option>
            <option value="3" @if (@$contentPage->path_segments==3)
            selected
                    @endif>3</option>
            <option value="4" @if (@$contentPage->path_segments==4)
            selected
                    @endif>4</option>
        </select>
        <small>Select the number of path segments you need. default is 0</small>

    </div>
    <div class="form-group col-md-6 col-lg-5 no-rad">
        <label class="required" for="nickname">{{ trans('cruds.contentPage.fields.nickname') }}</label>
        <input class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}" type="text" name="nickname" id="nickname" value="{{ old('nickname', $contentPage->nickname ?? '') }}" required>
        @if($errors->has('nickname'))
            <span class="text-danger">{{ $errors->first('nickname') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentPage.fields.nickname_helper') }}</span>
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
</div>

