@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.staticSeo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.static-seos.store") }}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>{{ trans('cruds.staticSeo.fields.content_type') }}</label>
                <select class="form-control {{ $errors->has('content_type') ? 'is-invalid' : '' }}" name="content_type" id="content_type">
                    <option value disabled {{ old('content_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\StaticSeo::CONTENT_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('content_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('content_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.staticSeo.fields.content_type_helper') }}</span>
            </div>

            <input type="hidden" name="canonical" id="canonical" value="1">
            
            <div class="form-group">
                <button class="btn btn-info" type="submit">
                    Next
                </button>
            </div>
        </form>
    </div>
</div>



@endsection