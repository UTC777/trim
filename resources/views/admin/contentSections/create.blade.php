@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contentSection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-sections.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="section_title">{{ trans('cruds.contentSection.fields.section_title') }}</label>
                <input class="form-control {{ $errors->has('section_title') ? 'is-invalid' : '' }}" type="text" name="section_title" id="section_title" value="{{ old('section_title', '') }}" required>
                @if($errors->has('section_title'))
                    <span class="text-danger">{{ $errors->first('section_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.section_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order">{{ trans('cruds.contentSection.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order', '') }}" step="1">
                @if($errors->has('order'))
                    <span class="text-danger">{{ $errors->first('order') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.order_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="section">{{ trans('cruds.contentSection.fields.section') }}</label>
                <textarea class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section">{{ old('section') }}</textarea>
                @if($errors->has('section'))
                    <span class="text-danger">{{ $errors->first('section') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.section_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.contentSection.fields.location') }}</label>
                <select class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location">
                    <option value disabled {{ old('location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ContentSection::LOCATION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('location', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="published" value="0">
                    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="published">{{ trans('cruds.contentSection.fields.published') }}</label>
                </div>
                @if($errors->has('published'))
                    <span class="text-danger">{{ $errors->first('published') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pages">{{ trans('cruds.contentSection.fields.pages') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('pages') ? 'is-invalid' : '' }}" name="pages[]" id="pages" multiple>
                    @foreach($pages as $id => $page)
                        <option value="{{ $id }}" {{ in_array($id, old('pages', [])) ? 'selected' : '' }}>{{ $page }}</option>
                    @endforeach
                </select>
                @if($errors->has('pages'))
                    <span class="text-danger">{{ $errors->first('pages') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentSection.fields.pages_helper') }}</span>
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