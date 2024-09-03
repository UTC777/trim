@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-9">

        <div class="card">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('cruds.slider.title_singular') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("admin.sliders.update", [$slider->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col">
                            <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                                <input type="hidden" name="published" value="0">
                                <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $slider->published || old('published', 0) === 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="published">{{ trans('cruds.slider.fields.published') }}</label>
                            </div>
                            @if($errors->has('published'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('published') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.published_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label>{{ trans('cruds.slider.fields.location') }}</label>
                            <select class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location">
                                <option value disabled {{ old('location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Slider::LOCATION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('location', $slider->location) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.location_helper') }}</span>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="slider_name">{{ trans('cruds.slider.fields.slider_name') }}</label>--}}
{{--                        <input class="form-control {{ $errors->has('slider_name') ? 'is-invalid' : '' }}" type="text" name="slider_name" id="slider_name" value="{{ old('slider_name', '') }}">--}}
{{--                        @if($errors->has('slider_name'))--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                {{ $errors->first('slider_name') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                        <span class="help-block">{{ trans('cruds.slider.fields.slider_name_helper') }}</span>--}}
{{--                    </div>--}}

                    <hr />

                    <div class="row">
                        <div class="form-group col">
                            <label for="main_title">{{ trans('cruds.slider.fields.main_title') }}</label>
                            <input class="form-control {{ $errors->has('main_title') ? 'is-invalid' : '' }}" type="text" name="main_title" id="main_title" value="{{ old('main_title', $slider->main_title) }}">
                            @if($errors->has('main_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_title_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="main_title_css">{{ trans('cruds.slider.fields.main_title_css') }}</label>
                            <input class="form-control {{ $errors->has('main_title_css') ? 'is-invalid' : '' }}" type="text" name="main_title_css" id="main_title_css" value="{{ old('main_title_css', $slider->main_title_css) }}">
                            @if($errors->has('main_title_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_title_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_title_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="sub_title">{{ trans('cruds.slider.fields.sub_title') }}</label>
                            <input class="form-control {{ $errors->has('sub_title') ? 'is-invalid' : '' }}" type="text" name="sub_title" id="sub_title" value="{{ old('sub_title', $slider->sub_title) }}">
                            @if($errors->has('sub_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.sub_title_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="sub_title_css">{{ trans('cruds.slider.fields.sub_title_css') }}</label>
                            <input class="form-control {{ $errors->has('sub_title_css') ? 'is-invalid' : '' }}" type="text" name="sub_title_css" id="sub_title_css" value="{{ old('sub_title_css', $slider->sub_title_css) }}">
                            @if($errors->has('sub_title_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.sub_title_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="sub_title_2">{{ trans('cruds.slider.fields.sub_title_2') }}</label>
                            <input class="form-control {{ $errors->has('sub_title_2') ? 'is-invalid' : '' }}" type="text" name="sub_title_2" id="sub_title_2" value="{{ old('sub_title_2', $slider->sub_title_2) }}">
                            @if($errors->has('sub_title_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.sub_title_2_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="sub_title_2_css">{{ trans('cruds.slider.fields.sub_title_2_css') }}</label>
                            <input class="form-control {{ $errors->has('sub_title_2_css') ? 'is-invalid' : '' }}" type="text" name="sub_title_2_css" id="sub_title_2_css" value="{{ old('sub_title_2_css', $slider->sub_title_2_css) }}">
                            @if($errors->has('sub_title_2_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sub_title_2_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.sub_title_2_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="slider_description">{{ trans('cruds.slider.fields.slider_description') }}</label>
                        <textarea class="form-control {{ $errors->has('slider_description') ? 'is-invalid' : '' }}" name="slider_description" id="slider_description">{{ old('slider_description', $slider->slider_description) }}</textarea>
                        @if($errors->has('slider_description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('slider_description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.slider.fields.slider_description_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="slider_description_css">{{ trans('cruds.slider.fields.slider_description_css') }}</label>
                        <input class="form-control {{ $errors->has('slider_description_css') ? 'is-invalid' : '' }}" type="text" name="slider_description_css" id="slider_description_css" value="{{ old('slider_description_css', $slider->slider_description_css) }}">
                        @if($errors->has('slider_description_css'))
                            <div class="invalid-feedback">
                                {{ $errors->first('slider_description_css') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.slider.fields.slider_description_css_helper') }}</span>
                    </div>


                    <div class="row">
                        <div class="form-group col">
                            <label for="text_heading">{{ trans('cruds.slider.fields.text_heading') }}</label>
                            <input class="form-control {{ $errors->has('text_heading') ? 'is-invalid' : '' }}" type="text" name="text_heading" id="text_heading" value="{{ old('text_heading', $slider->text_heading) }}">
                            @if($errors->has('text_heading'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text_heading') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.text_heading_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="text_heading_css">{{ trans('cruds.slider.fields.text_heading_css') }}</label>
                            <input class="form-control {{ $errors->has('text_heading_css') ? 'is-invalid' : '' }}" type="text" name="text_heading_css" id="text_heading_css" value="{{ old('text_heading_css', $slider->text_heading_css) }}">
                            @if($errors->has('text_heading_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text_heading_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.text_heading_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="heading_1">{{ trans('cruds.slider.fields.heading_1') }}</label>
                            <input class="form-control {{ $errors->has('heading_1') ? 'is-invalid' : '' }}" type="text" name="heading_1" id="heading_1" value="{{ old('heading_1', $slider->heading_1) }}">
                            @if($errors->has('heading_1'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_1') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_1_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="heading_1_css">{{ trans('cruds.slider.fields.heading_1_css') }}</label>
                            <input class="form-control {{ $errors->has('heading_1_css') ? 'is-invalid' : '' }}" type="text" name="heading_1_css" id="heading_1_css" value="{{ old('heading_1_css', $slider->heading_1_css) }}">
                            @if($errors->has('heading_1_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_1_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_1_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="heading_2">{{ trans('cruds.slider.fields.heading_2') }}</label>
                            <input class="form-control {{ $errors->has('heading_2') ? 'is-invalid' : '' }}" type="text" name="heading_2" id="heading_2" value="{{ old('heading_2', $slider->heading_2) }}">
                            @if($errors->has('heading_2'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_2') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_2_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="heading_2_css">{{ trans('cruds.slider.fields.heading_2_css') }}</label>
                            <input class="form-control {{ $errors->has('heading_2_css') ? 'is-invalid' : '' }}" type="text" name="heading_2_css" id="heading_2_css" value="{{ old('heading_2_css', $slider->heading_2_css) }}">
                            @if($errors->has('heading_2_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_2_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_2_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="heading_3">{{ trans('cruds.slider.fields.heading_3') }}</label>
                            <input class="form-control {{ $errors->has('heading_3') ? 'is-invalid' : '' }}" type="text" name="heading_3" id="heading_3" value="{{ old('heading_3', $slider->heading_3) }}">
                            @if($errors->has('heading_3'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_3') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_3_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="heading_3_css">{{ trans('cruds.slider.fields.heading_3_css') }}</label>
                            <input class="form-control {{ $errors->has('heading_3_css') ? 'is-invalid' : '' }}" type="text" name="heading_3_css" id="heading_3_css" value="{{ old('heading_3_css', $slider->heading_3_css) }}">
                            @if($errors->has('heading_3_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('heading_3_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.heading_3_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">


                        <div class="form-group col-12">
                            <label for="text">{{ trans('cruds.slider.fields.text') }}</label>
                            <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text" id="text">{{ old('text', $slider->text) }}</textarea>
                            @if($errors->has('text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.text_helper') }}</span>
                        </div>

                        <div class="form-group col">
                            <label for="text_css">{{ trans('cruds.slider.fields.text_css') }}</label>
                            <input class="form-control {{ $errors->has('text_css') ? 'is-invalid' : '' }}" type="text" name="text_css" id="text_css" value="{{ old('text_css', $slider->text_css) }}">
                            @if($errors->has('text_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('text_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.text_css_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="main_button_text">{{ trans('cruds.slider.fields.main_button_text') }}</label>
                            <input class="form-control {{ $errors->has('main_button_text') ? 'is-invalid' : '' }}" type="text" name="main_button_text" id="main_button_text" value="{{ old('main_button_text', $slider->main_button_text) }}">
                            @if($errors->has('main_button_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_button_text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_button_text_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="main_button_link">{{ trans('cruds.slider.fields.main_button_link') }}</label>
                            <input class="form-control {{ $errors->has('main_button_link') ? 'is-invalid' : '' }}" type="text" name="main_button_link" id="main_button_link" value="{{ old('main_button_link', $slider->main_button_link) }}">
                            @if($errors->has('main_button_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_button_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_button_link_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="main_button_tab_index">{{ trans('cruds.slider.fields.main_button_tab_index') }}</label>
                            <input class="form-control {{ $errors->has('main_button_tab_index') ? 'is-invalid' : '' }}" type="number" name="main_button_tab_index" id="main_button_tab_index" value="{{ old('main_button_tab_index', $slider->main_button_tab_index) }}" step="1">
                            @if($errors->has('main_button_tab_index'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_button_tab_index') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_button_tab_index_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="main_button_css">{{ trans('cruds.slider.fields.main_button_css') }}</label>
                            <input class="form-control {{ $errors->has('main_button_css') ? 'is-invalid' : '' }}" type="text" name="main_button_css" id="main_button_css" value="{{ old('main_button_css', $slider->main_button_css) }}">
                            @if($errors->has('main_button_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_button_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_button_css_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="main_button_icon_class">{{ trans('cruds.slider.fields.main_button_icon_class') }}</label>
                            <input class="form-control {{ $errors->has('main_button_icon_class') ? 'is-invalid' : '' }}" type="text" name="main_button_icon_class" id="main_button_icon_class" value="{{ old('main_button_icon_class', $slider->main_button_icon_class) }}">
                            @if($errors->has('main_button_icon_class'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('main_button_icon_class') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.main_button_icon_class_helper') }}</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col">
                            <label for="second_button_text">{{ trans('cruds.slider.fields.second_button_text') }}</label>
                            <input class="form-control {{ $errors->has('second_button_text') ? 'is-invalid' : '' }}" type="text" name="second_button_text" id="second_button_text" value="{{ old('second_button_text', $slider->second_button_text) }}">
                            @if($errors->has('second_button_text'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_button_text') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.second_button_text_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="second_button_link">{{ trans('cruds.slider.fields.second_button_link') }}</label>
                            <input class="form-control {{ $errors->has('second_button_link') ? 'is-invalid' : '' }}" type="text" name="second_button_link" id="second_button_link" value="{{ old('second_button_link', $slider->second_button_link) }}">
                            @if($errors->has('second_button_link'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_button_link') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.second_button_link_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="second_button_tab_index">{{ trans('cruds.slider.fields.second_button_tab_index') }}</label>
                            <input class="form-control {{ $errors->has('second_button_tab_index') ? 'is-invalid' : '' }}" type="number" name="second_button_tab_index" id="second_button_tab_index" value="{{ old('second_button_tab_index', $slider->second_button_tab_index) }}" step="1">
                            @if($errors->has('second_button_tab_index'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_button_tab_index') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.second_button_tab_index_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="second_button_css">{{ trans('cruds.slider.fields.second_button_css') }}</label>
                            <input class="form-control {{ $errors->has('second_button_css') ? 'is-invalid' : '' }}" type="text" name="second_button_css" id="second_button_css" value="{{ old('second_button_css', $slider->second_button_css) }}">
                            @if($errors->has('second_button_css'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_button_css') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.second_button_css_helper') }}</span>
                        </div>
                        <div class="form-group col">
                            <label for="second_button_icon_class">{{ trans('cruds.slider.fields.second_button_icon_class') }}</label>
                            <input class="form-control {{ $errors->has('second_button_icon_class') ? 'is-invalid' : '' }}" type="text" name="second_button_icon_class" id="second_button_icon_class" value="{{ old('second_button_icon_class', $slider->second_button_icon_class) }}">
                            @if($errors->has('second_button_icon_class'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('second_button_icon_class') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.slider.fields.second_button_icon_class_helper') }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">{{ trans('cruds.slider.fields.image') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                        </div>
                        @if($errors->has('image'))
                            <div class="invalid-feedback">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.slider.fields.image_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-3">
        <div class="sidebar-css-cheatsheet">
            <h4>CSS Cheat Sheet</h4>
            <ul>
                <li onclick="toggleVisibility('color-explanation')"> <strong>Color:</strong> color: #333; or color: red;
                    <p id="color-explanation" class="explanation" style="display:none;">Defines the text color. Possible values: hex (#000000), RGB (rgb(0,0,0)), RGBA (rgba(0,0,0,0.5)), and color names (black, red).</p>
                </li>
                <li onclick="toggleVisibility('margin-explanation')"> <strong>Margin:</strong> margin: 20px;
                    <p id="margin-explanation" class="explanation" style="display:none;">Controls the outer space around an element. Values: pixels (px), percentages (%), ems (em). Can specify each side individually (top, right, bottom, left).</p>
                </li>
                <li onclick="toggleVisibility('padding-explanation')"> <strong>Padding:</strong> padding: 20px;
                    <p id="padding-explanation" class="explanation" style="display:none;">Controls the inner space between an element's border and its content. Values: pixels (px), percentages (%), ems (em). Can specify each side individually.</p>
                </li>
                <li onclick="toggleVisibility('font-size-explanation')"> <strong>Font Size:</strong> font-size: 16px;
                    <p id="font-size-explanation" class="explanation" style="display:none;">Determines the size of the text. Values: pixels (px), root em (rem), ems (em), percentages (%). My prferred is rem because it is responsive and changes when the screensize changes.</p>
                </li>
                <li onclick="toggleVisibility('font-weight-explanation')"> <strong>Font Weight:</strong> font-weight: bold;
                    <p id="font-weight-explanation" class="explanation" style="display:none;">Sets the thickness of the text. Values: normal, bold, bolder, lighter, or numerical values (100 to 900).</p>
                </li>
                <li onclick="toggleVisibility('text-decoration-explanation')"> <strong>Text Decoration:</strong> text-decoration: underline;
                    <p id="text-decoration-explanation" class="explanation" style="display:none;">Specifies the decoration of the text. Values: none, underline, overline, line-through, blink.</p>
                </li>
                <li onclick="toggleVisibility('background-color-explanation')"> <strong>Background Color:</strong> background-color: #eee;
                    <p id="background-color-explanation" class="explanation" style="display:none;">Sets the background color of an element. Values: hex, RGB, RGBA, color names.</p>
                </li>
                <li onclick="toggleVisibility('border-explanation')"> <strong>Border:</strong> border: 1px solid #333;
                    <p id="border-explanation" class="explanation" style="display:none;">Defines the border around an element. Syntax: border: [border-width] [border-style] [border-color]. Styles: solid, dotted, dashed, double, groove, ridge, inset, outset.</p>
                </li>
                <li onclick="toggleVisibility('font-style-explanation')"> <strong>Font Style:</strong> font-style: italic;
                    <p id="font-style-explanation" class="explanation" style="display:none;">Specifies the font style for text. Values: normal, italic, oblique.</p>
                </li>
            </ul>
            <p>If CSS is not working, add "!important" after the value but before the semicolon. Example: font-size: 16px !important;</p>
        </div>
    </div>

</div>




@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
    @if(isset($slider) && $slider->image)
          var file = {!! json_encode($slider->image) !!}
              this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
          this.options.maxFiles = this.options.maxFiles - 1
    @endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
<script>
    function toggleVisibility(id) {
        var element = document.getElementById(id);
        if (element.style.display === "none") {
            element.style.display = "block";
        } else {
            element.style.display = "none";
        }
    }
</script>
@endsection
