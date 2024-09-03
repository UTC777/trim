@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.redirector.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.redirectors.update", [$redirector->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $redirector->published || old('published', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.redirector.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="redirect_from">{{ trans('cruds.redirector.fields.redirect_from') }}</label>
                <input class="form-control {{ $errors->has('redirect_from') ? 'is-invalid' : '' }}" type="text" name="redirect_from" id="redirect_from" value="{{ old('redirect_from', $redirector->redirect_from) }}">
                @if($errors->has('redirect_from'))
                    <span class="text-danger">{{ $errors->first('redirect_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.redirect_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="redirect_to">{{ trans('cruds.redirector.fields.redirect_to') }}</label>
                <input class="form-control {{ $errors->has('redirect_to') ? 'is-invalid' : '' }}" type="text" name="redirect_to" id="redirect_to" value="{{ old('redirect_to', $redirector->redirect_to) }}">
                @if($errors->has('redirect_to'))
                    <span class="text-danger">{{ $errors->first('redirect_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.redirect_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.redirector.fields.http_code') }}</label>
                <select class="form-control {{ $errors->has('http_code') ? 'is-invalid' : '' }}" name="http_code" id="http_code">
                    <option value disabled {{ old('http_code', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Redirector::HTTP_CODE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('http_code', $redirector->http_code) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('http_code'))
                    <span class="text-danger">{{ $errors->first('http_code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.http_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="post_id">{{ trans('cruds.redirector.fields.post') }}</label>
                <select class="form-control select2 {{ $errors->has('post') ? 'is-invalid' : '' }}" name="post_id" id="post_id">
                    @foreach($posts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('post_id') ? old('post_id') : $redirector->post->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('post'))
                    <span class="text-danger">{{ $errors->first('post') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.post_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection