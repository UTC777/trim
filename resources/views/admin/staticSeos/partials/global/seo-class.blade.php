<div class="row d-flex border border-dark align-baseline p-2 m-0 mb-2 bg-dark">
    <div class="form-group text-light col-3">
        <label for="html_classes">{{ trans('cruds.staticSeo.fields.html_classes') }}</label>
        <input class="form-control {{ $errors->has('html_classes') ? 'is-invalid' : '' }}" type="text" name="seo[html_classes]" id="html_classes" value="{{ old('html_classes', $staticSeo->html_classes ?? '') }}">
        @if($errors->has('html_classes'))
            <span class="text-danger">{{ $errors->first('html_classes') }}</span>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="body_classes">{{ trans('cruds.staticSeo.fields.body_classes') }}</label>
        <input class="form-control {{ $errors->has('body_classes') ? 'is-invalid' : '' }}" type="text" name="seo[body_classes]" id="body_classes" value="{{ old('body_classes', $staticSeo->body_classes ?? '') }}">
        @if($errors->has('body_classes'))
            <span class="text-danger">{{ $errors->first('body_classes') }}</span>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="main_classes">{{ trans('cruds.staticSeo.fields.main_classes') }}</label>
        <input class="form-control {{ $errors->has('main_classes') ? 'is-invalid' : '' }}" type="text" name="seo[main_classes]" id="main_classes" value="{{ old('main_classes', $staticSeo->main_classes ?? '') }}">
        @if($errors->has('main_classes'))
            <span class="text-danger">{{ $errors->first('main_classes') }}</span>
        @endif
    </div>
    <div class="form-group col-3">
        <label for="footer_classes">{{ trans('cruds.staticSeo.fields.footer_classes') }}</label>
        <input class="form-control {{ $errors->has('footer_classes') ? 'is-invalid' : '' }}" type="text" name="seo[footer_classes]" id="footer_classes" value="{{ old('footer_classes', $staticSeo->footer_classes ?? '') }}">
        @if($errors->has('footer_classes'))
            <span class="text-danger">{{ $errors->first('footer_classes') }}</span>
        @endif
    </div>
</div>
