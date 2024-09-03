<form>
    @csrf
    <!-- Modal Header -->
    <div class="modal-header">
    <h4 class="modal-title"> {{ @$contentSection? 'Edit':'Create' }}  {{ trans('cruds.contentSection.title_singular') }}</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <!-- Modal body -->
    <div class="modal-body">
    <input type="hidden" name="id" id="content_section_id" class="form-control" value="{{ @$contentSection->id }}">

    <div class="form-group">
        <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
            <input type="hidden" name="published" value="0">
            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ @$contentSection->published || old('published', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="published">{{ trans('cruds.contentSection.fields.published') }}</label>
        </div>
        @if($errors->has('published'))
            <span class="text-danger">{{ $errors->first('published') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentSection.fields.published_helper') }}</span>
    </div>
    <div class="form-group">
        <label class="required" for="section_title">{{ trans('cruds.contentSection.fields.section_title') }}</label>
        <input class="form-control {{ $errors->has('section_title') ? 'is-invalid' : '' }}" type="text" name="section_title" id="section_title" value="{{ old('section_title', @$contentSection->section_title) }}" required>
        @if($errors->has('section_title'))
            <span class="text-danger">{{ $errors->first('section_title') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentSection.fields.section_title_helper') }}</span>
    </div>
    <div class="form-group">
        <label>{{ trans('cruds.contentSection.fields.location') }}</label>
        <select class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" name="location" id="location">
            <option value disabled {{ old('location', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\ContentSection::LOCATION_SELECT as $key => $label)
                <option value="{{ $key }}" {{ old('location', @$contentSection->location) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('location'))
            <span class="text-danger">{{ $errors->first('location') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentSection.fields.location_helper') }}</span>
    </div>
    <div class="form-group">
        <label for="section">{{ trans('cruds.contentSection.fields.section') }}</label>
        <textarea class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="section">{{ old('section', @$contentSection->section) }}</textarea>
        @if($errors->has('section'))
            <span class="text-danger">{{ $errors->first('section') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.contentSection.fields.section_helper') }}</span>
    </div>

    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
    <button type="button" class="btn btn-info" id="saveContentSection">Save</button>
    </div>
</form>
