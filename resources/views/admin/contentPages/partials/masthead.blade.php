


<div class="form-row">

   <div class="col-md-2">
        <div class="form-group">
            <div class="form-check {{ $errors->has('use_rev_slider') ? 'is-invalid' : '' }}">
                <input type="hidden" name="use_rev_slider" value="0">
               @if (isset($contentPage))
               <input class="form-check-input" type="checkbox" name="use_rev_slider" id="use_rev_slider" value="1" {{ $contentPage->use_rev_slider || old('use_rev_slider', 0) === 1 ? 'checked' : '' }}>
               @else
                    <input class="form-check-input" type="checkbox" name="use_rev_slider" id="use_rev_slider" value="1" {{ old('use_rev_slider', 0) == 1 || old('use_rev_slider') === null ? '' : '' }}>
                @endif
                <label class="form-check-label" for="use_rev_slider">{{ trans('cruds.contentPage.fields.use_rev_slider') }}</label>
            </div>
            @if($errors->has('use_rev_slider'))
                <span class="text-danger">{{ $errors->first('use_rev_slider') }}</span>
           @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.use_rev_slider_helper') }}</span>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <div class="form-check {{ $errors->has('use_textonly_header') ? 'is-invalid' : '' }}">
                <input type="hidden" name="use_textonly_header" value="0">
                @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="use_textonly_header" id="use_textonly_header" value="1" {{ $contentPage->use_textonly_header || old('use_textonly_header', 0) === 1 ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" type="checkbox" name="use_textonly_header" id="use_textonly_header" value="1" {{ old('use_textonly_header', 0) == 1 || old('use_textonly_header') === null ? '' : '' }}>
                @endif

                <label class="form-check-label" for="use_textonly_header">{{ trans('cruds.contentPage.fields.use_textonly_header') }}</label>
            </div>
            @if($errors->has('use_textonly_header'))
                <span class="text-danger">{{ $errors->first('use_textonly_header') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.use_textonly_header_helper') }}</span>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <div class="form-check {{ $errors->has('use_svg_header') ? 'is-invalid' : '' }}">
                <input type="hidden" name="use_svg_header" value="0">
                @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="use_svg_header" id="use_svg_header" value="1" {{ $contentPage->use_svg_header || old('use_svg_header', 0) === 1 ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" type="checkbox" name="use_svg_header" id="use_svg_header" value="1" {{ old('use_svg_header', 0) == 1 || old('use_svg_header') === null ? '' : '' }}>
                @endif

                <label class="form-check-label" for="use_svg_header">{{ trans('cruds.contentPage.fields.use_svg_header') }}</label>
            </div>
            @if($errors->has('use_svg_header'))
                <span class="text-danger">{{ $errors->first('use_svg_header') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.use_svg_header_helper') }}</span>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <div class="form-check {{ $errors->has('use_featured_image_header') ? 'is-invalid' : '' }}">
                <input type="hidden" name="use_featured_image_header" value="0">
                @if (isset($contentPage))
                <input class="form-check-input" type="checkbox" name="use_featured_image_header" id="use_featured_image_header" value="1" {{ $contentPage->use_featured_image_header || old('use_featured_image_header', 0) === 1 ? 'checked' : '' }}>
                @else
                    <input class="form-check-input" type="checkbox" name="use_featured_image_header" id="use_featured_image_header" value="1" {{ old('use_featured_image_header', 0) == 1 || old('use_featured_image_header') === null ? '' : '' }}>
                @endif

                <label class="form-check-label" for="use_featured_image_header">{{ trans('cruds.contentPage.fields.use_featured_image_header') }}</label>
            </div>
            @if($errors->has('use_featured_image_header'))
                <span class="text-danger">{{ $errors->first('use_featured_image_header') }}</span>
            @endif
            <span class="help-block">{{ trans('cruds.contentPage.fields.use_featured_image_header_helper') }}</span>
        </div>
    </div>
</div>


<div id="use_rev_slider_box" @if (isset($contentPage)) @if(@$contentPage->use_rev_slider==false) style="display:none;"  @endif @endif>
    <div class="col-lg-12">
        <div class="form-group">
            <label>SLIDERS</label>
            <select class="form-control select2 {{ $errors->has('sliders') ? 'is-invalid' : '' }}" name="sliders[]" id="sliders" multiple>
                @foreach($sliders as $id => $slider)
                @if (@$contentPage)
                    <option value="{{ $id }}" {{ (in_array($id, old('sliders', [])) || @$contentPage->sliders->contains($id)) ? 'selected' : '' }}>{{ $slider }}</option>
                @else
                    <option value="{{ $id }}">{{ $slider }}</option>
                @endif

                @endforeach
            </select>
        </div>
    </div>
</div>


<div id="use_textonly_header_box" @if (isset($contentPage)) @if(@$contentPage->use_textonly_header==false &&  @$contentPage->use_featured_image_header==false) style="display:none;"  @endif @endif>
    <div class="col-lg-6">
        <div class="form-group">
        <label>HEADER TITLE
            {{-- {{ trans('cruds.page.fields.show_title') }}
            |
            {{ trans('cruds.page.fields.title_style') }} --}}
        </label>
            <div class="input-group">
                <input type="hidden" name="show_featured_content" value="0">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <input type="hidden" name="show_title" value="0">
                        @if (isset($contentPage))
                            <input type="checkbox" name="show_title" id="show_title" value="1" {{ $contentPage->show_title || old('show_title', 0) === 1 ? 'checked' : '' }}>
                        @else
                            <input type="checkbox" name="show_title" id="show_title" value="1" {{ old('show_title', 0) == 1 || old('show_title') === null ? 'checked' : '' }}>
                        @endif
                    </span>
            </div>
            <select class="form-control {{ $errors->has('title_style') ? 'is-invalid' : '' }}" name="title_style" id="title_style">
                <option value disabled {{ old('title_style', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach(App\Models\contentPage::TITLE_STYLE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('title_style', @$contentPage->title_style) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            </div>
        </div>

    </div>




    <div class="col-lg-6">
        <div class="form-group">
        <label>HEADER SUB TITLE
            {{-- {{ trans('cruds.page.fields.show_tagline') }}
            |
            {{ trans('cruds.page.fields.tagline_style') }} --}}
        </label>
            <div class="input-group">
                <input type="hidden" name="show_featured_content" value="0">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                            <input type="hidden" name="show_tagline" value="0">
                        @if (isset($contentPage))
                            <input type="checkbox" name="show_tagline" id="show_tagline" value="1" {{ $contentPage->show_tagline || old('show_tagline', 0) === 1 ? 'checked' : '' }}>
                        @else
                            <input type="checkbox" name="show_tagline" id="show_tagline" value="1" {{ old('show_tagline', 0) == 1 || old('show_tagline') === null ? 'checked' : '' }}>
                        @endif
                    </span>
            </div>

             <select class="form-control {{ $errors->has('tagline_style') ? 'is-invalid' : '' }}" name="tagline_style" id="tagline_style">
                <option value disabled {{ old('tagline_style', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                @foreach(App\Models\contentPage::TAGLINE_STYLE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('tagline_style', @$contentPage->tagline_style) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            </div>
        </div>

    </div>
</div>


<div id="use_svg_header_box" @if (isset($contentPage)) @if(@$contentPage->use_featured_image_header==false) style="display:none;"  @endif @endif>
        <div class="col-lg-6">
            <div class="form-group">
            <label>HEADER FEATURED IMAGE CONTENT </label>
                <div class="input-group">
                    <input type="hidden" name="show_featured_content" value="0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <input type="hidden" name="show_featured_content" value="0">
                            @if (isset($contentPage))
                                <input type="checkbox" name="show_featured_content" id="show_featured_content" value="1" {{ $contentPage->show_featured_content || old('show_featured_content', 0) === 1 ? 'checked' : '' }}>
                            @else
                                <input type="checkbox" name="show_featured_content" id="show_featured_content" value="1" {{ old('show_featured_content', 0) == 1 || old('show_featured_content') === null ? 'checked' : '' }}>
                            @endif
                        </span>
                </div>
                <select class="form-control {{ $errors->has('fi_content_style') ? 'is-invalid' : '' }}" name="fi_content_style" id="fi_content_style">
                    <option value disabled {{ old('fi_content_style', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\contentPage::FI_CONTENT_STYLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('fi_content_style', @$contentPage->fi_content_style) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>


                </div>
            </div>

        </div>



    <div class="form-group">
    <label for="featured_image_content">{{ trans('cruds.contentPage.fields.featured_image_content') }}</label>
    <textarea class="form-control {{ $errors->has('featured_image_content') ? 'is-invalid' : '' }}" name="featured_image_content" id="featured_image_content">{{ old('featured_image_content', @$contentPage->featured_image_content) }}</textarea>
    <small>Put text you want to show up on masthead image here.</small>
    @if($errors->has('featured_image_content'))
    <span class="text-danger">{{ $errors->first('featured_image_content') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.contentPage.fields.featured_image_content_helper') }}</span>
    </div>
</div>



<div class="form-group" id="use_featured_image_header_box" @if (isset($contentPage)) @if(@$contentPage->use_svg_header==false) style="display:none;"  @endif @endif>
    <label for="svg_masthead">{{ trans('cruds.contentPage.fields.svg_masthead') }}</label>
    <textarea class="form-control {{ $errors->has('svg_masthead') ? 'is-invalid' : '' }}" name="svg_masthead" id="svg_masthead">{{ old('svg_masthead', @$contentPage->svg_masthead) }}</textarea>
    @if($errors->has('svg_masthead'))
        <span class="text-danger">{{ $errors->first('svg_masthead') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.contentPage.fields.svg_masthead_helper') }}</span>
</div>
