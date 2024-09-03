<div class="row">
    <div class="col-md-12 bg-dark p-3" style="display: flex; flex-direction: row;">
        <div class="d-flex flex-wrap align-items-center">
            <div class="form-check form-check-inline mx-2">
                <input type="hidden" name="canonical" value="0">
                <input class="form-check-input" type="checkbox" name="seo[canonical]" id="canonical" value="1" {{ $staticSeo->canonical || old('canonical', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="canonical">{{ trans('cruds.staticSeo.fields.canonical') }}</label>
            </div>
            <div class="form-check form-check-inline mx-2 {{ $errors->has('noindex') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noindex" value="0">
                <input class="form-check-input" type="checkbox" name="seo[noindex]" id="noindex" value="1" {{ $staticSeo->noindex || old('noindex', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noindex">{{ trans('cruds.staticSeo.fields.noindex') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" data-bs-original-title="{{ trans('cruds.staticSeo.fields.noindex_helper') }}"></i>
            </div>
            @if($errors->has('noindex'))
                <span class="text-danger">{{ $errors->first('noindex') }}</span>
            @endif
            <div class="form-check form-check-inline mx-2 {{ $errors->has('nofollow') ? 'is-invalid' : '' }}">
                <input type="hidden" name="nofollow" value="0">
                <input class="form-check-input" type="checkbox" name="seo[nofollow]" id="nofollow" value="1" {{ $staticSeo->nofollow || old('nofollow', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="nofollow">{{ trans('cruds.staticSeo.fields.nofollow') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" data-bs-original-title="{{ trans('cruds.staticSeo.fields.nofollow_helper') }}"></i>
            </div>
            @if($errors->has('nofollow'))
                <span class="text-danger">{{ $errors->first('nofollow') }}</span>
            @endif
            <div class="form-check form-check-inline mx-2 {{ $errors->has('noimageindex') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noimageindex" value="0">
                <input class="form-check-input" type="checkbox" name="seo[noimageindex]" id="noimageindex" value="1" {{ $staticSeo->noimageindex || old('noimageindex', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noimageindex">{{ trans('cruds.staticSeo.fields.noimageindex') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" data-bs-original-title="{{ trans('cruds.staticSeo.fields.noimageindex_helper') }}"></i>
            </div>
            @if($errors->has('noimageindex'))
                <span class="text-danger">{{ $errors->first('noimageindex') }}</span>
            @endif
            <div class="form-check form-check-inline mx-2 {{ $errors->has('noarchive') ? 'is-invalid' : '' }}">
                <input type="hidden" name="noarchive" value="0">
                <input class="form-check-input" type="checkbox" name="seo[noarchive]" id="noarchive" value="1" {{ $staticSeo->noarchive || old('noarchive', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="noarchive">{{ trans('cruds.staticSeo.fields.noarchive') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" data-bs-original-title="{{ trans('cruds.staticSeo.fields.noarchive_helper') }}"></i>
            </div>
            @if($errors->has('noarchive'))
                <span class="text-danger">{{ $errors->first('noarchive') }}</span>
            @endif
            <div class="form-check form-check-inline mx-2 {{ $errors->has('nosnippet') ? 'is-invalid' : '' }}">
                <input type="hidden" name="nosnippet" value="0">
                <input class="form-check-input" type="checkbox" name="seo[nosnippet]" id="nosnippet" value="1" {{ $staticSeo->nosnippet || old('nosnippet', 0) === 1 ? 'checked' : '' }}>
                <label class="form-check-label text-light" for="nosnippet">{{ trans('cruds.staticSeo.fields.nosnippet') }}</label>
                <i class="fa-solid fa-circle-question" data-bs-toggle="tooltip" data-bs-animation="false" data-bs-placement="top" data-bs-original-title="{{ trans('cruds.staticSeo.fields.nosnippet_helper') }}"></i>
            </div>
            @if($errors->has('nosnippet'))
                <span class="text-danger">{{ $errors->first('nosnippet') }}</span>
            @endif
        </div>
    </div>
    <div class="form-group col-md-3 mt-2">
        <label for="menu_name">{{ trans('cruds.staticSeo.fields.menu_name') }}</label>
        <input class="form-control {{ $errors->has('menu_name') ? 'is-invalid' : '' }}" type="text" name="seo[menu_name]" id="menu_name" value="{{ old('menu_name', @$staticSeo->menu_name) }}">
        @if($errors->has('menu_name'))
            <span class="text-danger">{{ $errors->first('menu_name') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.menu_name_helper') }}</span>
    </div>
    <div class="form-group col-md-3 mt-2">
        <label>{{ trans('cruds.staticSeo.fields.content_type') }}</label>
        <select class="form-control {{ $errors->has('content_type') ? 'is-invalid' : '' }}" name="seo[content_type]" id="content_type" disabled>
            <option value disabled {{ old('content_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\StaticSeo::CONTENT_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('content_type', $staticSeo->content_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('content_type'))
            <span class="text-danger">{{ $errors->first('content_type') }}</span>
        @endif
    </div>
    <div class="form-group col-md-3 mt-2">
        <label>{{ trans('cruds.staticSeo.fields.open_graph_type') }}</label>
        <select class="form-control {{ $errors->has('open_graph_type') ? 'is-invalid' : '' }}" name="seo[open_graph_type]" id="open_graph_type">
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
