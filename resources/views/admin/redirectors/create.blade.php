@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.redirector.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.redirectors.store") }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.redirector.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="redirect_from">{{ trans('cruds.redirector.fields.redirect_from') }}</label>
                <input class="form-control {{ $errors->has('redirect_from') ? 'is-invalid' : '' }}" type="text" name="redirect_from" id="redirect_from" value="{{ old('redirect_from', '') }}">
                @if($errors->has('redirect_from'))
                    <span class="text-danger">{{ $errors->first('redirect_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.redirector.fields.redirect_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="redirect_to">{{ trans('cruds.redirector.fields.redirect_to') }}</label>
                <input class="form-control {{ $errors->has('redirect_to') ? 'is-invalid' : '' }}" type="text" name="redirect_to" id="redirect_to" value="{{ old('redirect_to', '') }}">
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
                        <option value="{{ $key }}" {{ old('http_code', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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
                        <option value="{{ $id }}" {{ old('post_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

{{-- <div class="mt-3">
  <form method="POST" action="{{ route("admin.redirectors.index") }}" enctype="multipart/form-data">
    <div class="form-group">
      <div class="form-check ">
        <input type="hidden" name="published" value="0">
        <input class="form-check-input" type="checkbox" name="published" id="published" value="1" checked="">
        <label class="form-check-label" for="published">Published</label>
      </div>
      <div class="input-group mb-1">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
        </div>
        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Redirect From ">
        <input type="text" class="form-control" aria-label="Text input with checkbox" placeholder="Redirect To '/'">

        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Code</button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">301</a></li>
          <li><a class="dropdown-item" href="#">302</a></li>
        </ul>
      </div>

  </form>

  <button class="push-to-add mt-3">Push to add</button>
</div> --}}

{{-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Post</button>
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="#">Posts Titles</a></li>
</ul> --}}

    </div>
</div>



@endsection


@section('scripts')
@parent
    <script>
        const btn = document.querySelector('.push-to-add');
        let counter = 0;
        btn.onclick = e => {
        e.preventDefault();

        let repeatingField = document.querySelector('.repeating');

        let newRepeating = document.createElement('div');
        newRepeating.className = 'input-group mb-1 repeating';

        let repeatingForm = `<div class="input-group-text">
            <input type="hidden" name="published" value="0">
            <input name="published[${1 + counter}][$value]" class="form-check-input mt-0" type="checkbox" value="">
            </div>
            <input id="redirect_from" name="redirect_from[${1 + counter}][$value]" type="text" class="form-control" aria-label="" placeholder="Redirect From ">
            <input id="redirect_to" name="redirect_to[${1 + counter}][$value]" type="text" class="form-control" aria-label="" placeholder="Redirect To '/'">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Code</button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">301</a></li>
            <li><a class="dropdown-item" href="#">302</a></li>
            </ul>
            </div>`;

        newRepeating.innerHTML = repeatingForm;
        btn.previousElementSibling.appendChild(newRepeating);

        counter += 1
        }
    </script>
@endsection
