<div class="row">
    <div class="col-md-12 bg-dark">
        <div class="form-group col">
            <div class="form-check {{ $errors->has('canonical') ? 'is-invalid' : '' }}">
                <input type="hidden" name="canonical" value="0">
                <input class="form-check-input" type="checkbox" name="canonical" id="canonical" value="1" {{ $staticSeo->canonical || old('canonical', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="canonical">{{ trans('cruds.staticSeo.fields.canonical') }}</label>
            </div>
        </div>
        <div class="form-group col">
            <div class="form-check {{ $errors->has('noindex') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noindex" value="0">
                <input class="form-check-input" type="checkbox" name="noindex" id="noindex" value="1" {{ $staticSeo->noindex || old('noindex', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noindex">{{ trans('cruds.staticSeo.fields.noindex') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top"
    data-bs-original-title="{{ trans('cruds.staticSeo.fields.noindex_helper') }}"></i>
            </div>
            @if($errors->has('noindex'))
                <span class="text-danger">{{ $errors->first('noindex') }}</span>
            @endif
            <span class="help-block"></span>
        </div>
        <div class="form-group col">
            <div class="form-check {{ $errors->has('nofollow') ? 'is-invalid' : '' }}">
                <input type="hidden" name="nofollow" value="0">
                <input class="form-check-input" type="checkbox" name="nofollow" id="nofollow" value="1" {{ $staticSeo->nofollow || old('nofollow', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="nofollow">{{ trans('cruds.staticSeo.fields.nofollow') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top"
    data-bs-original-title="{{ trans('cruds.staticSeo.fields.nofollow_helper') }}"></i>
            </div>
            @if($errors->has('nofollow'))
                <span class="text-danger">{{ $errors->first('nofollow') }}</span>
            @endif

        </div>
        <div class="form-group col">
            <div class="form-check {{ $errors->has('noimageindex') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noimageindex" value="0">
                <input class="form-check-input" type="checkbox" name="noimageindex" id="noimageindex" value="1" {{ $staticSeo->noimageindex || old('noimageindex', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noimageindex">{{ trans('cruds.staticSeo.fields.noimageindex') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top"
    data-bs-original-title="{{ trans('cruds.staticSeo.fields.noimageindex_helper') }}"></i>
            </div>
            @if($errors->has('noimageindex'))
                <span class="text-danger">{{ $errors->first('noimageindex') }}</span>
            @endif
            <span class="help-block"></span>
        </div>
        <div class="form-group col">
            <div class="form-check {{ $errors->has('noarchive') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noarchive" value="0">
                <input class="form-check-input" type="checkbox" name="noarchive" id="noarchive" value="1" {{ $staticSeo->noarchive || old('noarchive', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noarchive">{{ trans('cruds.staticSeo.fields.noarchive') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top"
    data-bs-original-title="{{ trans('cruds.staticSeo.fields.noarchive_helper') }}"></i>
            </div>
            @if($errors->has('noarchive'))
                <span class="text-danger">{{ $errors->first('noarchive') }}</span>
            @endif
            <span class="help-block"></span>
        </div>
        <div class="form-group col">
            <div class="form-check {{ $errors->has('nosnippet') ? 'is-invalid' : '' }}">
                <input type="hidden" name="nosnippet" value="0">
                <input class="form-check-input" type="checkbox" name="nosnippet" id="nosnippet" value="1" {{ $staticSeo->nosnippet || old('nosnippet', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="nosnippet">{{ trans('cruds.staticSeo.fields.nosnippet') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top"
    data-bs-original-title="{{ trans('cruds.staticSeo.fields.nosnippet_helper') }}"></i>
            </div>
            @if($errors->has('nosnippet'))
                <span class="text-danger">{{ $errors->first('nosnippet') }}</span>
            @endif
            <span class="help-block"></span>
        </div>

    </div>



    <div class="form-group col-md-3">
        <label for="menu_name">{{ trans('cruds.staticSeo.fields.menu_name') }}</label>
        <input class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}" type="text" name="menu_name" id="menu_name" value="{{ old('menu_name', @$staticSeo->menu_name) }}">
        @if($errors->has('menu_name'))
            <span class="text-danger">{{ $errors->first('menu_name') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.menu_name_helper') }}</span>
    </div>
    <div class="form-group col-md-3">
        <label>{{ trans('cruds.staticSeo.fields.content_type') }}</label>
        <select class="form-control {{ $errors->has('content_type') ? 'is-invalid' : '' }}" name="content_type" id="content_type">
            <option value disabled {{ old('content_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\StaticSeo::CONTENT_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('content_type', $staticSeo->content_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('content_type'))
            <span class="text-danger">{{ $errors->first('content_type') }}</span>
        @endif
    </div>
    <div class="form-group col-md-3">
        <label>{{ trans('cruds.staticSeo.fields.open_graph_type') }}</label>
        <select class="form-control {{ $errors->has('open_graph_type') ? 'is-invalid' : '' }}" name="open_graph_type" id="open_graph_type">
            <option value disabled {{ old('open_graph_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\StaticSeo::OPEN_GRAPH_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('open_graph_type', $staticSeo->open_graph_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('open_graph_type'))
            <span class="text-danger">{{ $errors->first('open_graph_type') }}</span>
        @endif
    </div>

</div>
