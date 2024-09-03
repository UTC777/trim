{{-- Landing page builder section only  --}}
@if ($staticSeo->content_type=='custom')

    <div id="landing-page-details" class="row mt-3">

        <div class="form-group col-5">
            <label for="page_name">{{ trans('cruds.staticSeo.fields.page_name') }}</label>
            <input class="form-control {{ $errors->has('page_name') ? 'is-invalid' : '' }}" type="text" name="page_name" id="page_name" value="{{ old('page_name', @$staticSeo->page_name) }}">
            @if($errors->has('page_name'))
                <span class="text-danger">{{ $errors->first('page_name') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.staticSeo.fields.page_name_helper') }}</span>
        </div>

        <div class="form-group col-5">
            <label for="page_path">{{ trans('cruds.staticSeo.fields.page_path') }}</label>
            <input class="form-control {{ $errors->has('page_path') ? 'is-invalid' : '' }}" type="text" name="page_path" id="page_path" value="{{ old('page_path', @$staticSeo->page_path) }}" readonly>
            @if($errors->has('page_path'))
                <span class="text-danger">{{ $errors->first('page_path') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.staticSeo.fields.page_path_helper') }}</span>
        </div>

        {{-- <div class="form-group col-10">
            <label for="seo_image">{{ trans('cruds.staticSeo.fields.seo_image') }}</label>
            <div class="needsclick dropzone {{ $errors->has('seo_image') ? 'is-invalid' : '' }}" id="seo_image-dropzone">
            </div>
            @if($errors->has('seo_image'))
                <span class="text-danger">{{ $errors->first('seo_image') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.staticSeo.fields.seo_image_helper') }}</span>
        </div>

        <input type="hidden" id="meta-featured-image" value="{{ $staticSeo->seo_image ? $staticSeo->seo_image->getUrl() : '' }}"> --}}

    </div>

@endif

