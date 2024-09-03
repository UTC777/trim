<form>
    @csrf
  <!-- Modal Header -->
  <div class="modal-header">
  <h4 class="modal-title"> {{ @$pageSection? 'Edit':'Create' }}  {{ trans('cruds.pagesection.title_singular') }}</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>
  
  <!-- Modal body -->
  <div class="modal-body">
    <input type="hidden" name="id" id="page_section_id" class="form-control" value="{{ @$pageSection->id }}">

    <div class="form-group">
        <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
            <input type="hidden" name="published" value="0">
            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ @$pageSection->published || old('published', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="published">{{ trans('cruds.pagesection.fields.published') }}</label>
        </div>
        @if($errors->has('published'))
            <span class="text-danger">{{ $errors->first('published') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.pagesection.fields.published_helper') }}</span>
    </div>
    <div class="form-group">
        <label for="section_nickname">{{ trans('cruds.pagesection.fields.section_nickname') }}</label>
        <input class="form-control {{ $errors->has('section_nickname') ? 'is-invalid' : '' }}" type="text" name="section_nickname" id="section_nickname" value="{{ old('section_nickname', @$pageSection->section_nickname) }}">
        @if($errors->has('section_nickname'))
            <span class="text-danger">{{ $errors->first('section_nickname') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.pagesection.fields.section_nickname_helper') }}</span>
    </div>
   
    <div class="form-group">
        <label for="PageSectionTxt">{{ trans('cruds.pagesection.fields.section') }}</label>
        <textarea class="form-control {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section" id="PageSectionTxt">{{ old('section', @$pageSection->section) }}</textarea>
        @if($errors->has('section'))
            <span class="text-danger">{{ $errors->first('section') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.pagesection.fields.section_helper') }}</span>
    </div>
        
  </div>
  
  <!-- Modal footer -->
  <div class="modal-footer">
  <button type="button" class="btn btn-info" id="savePageSection">Save</button>
  </div>
  </form>
  

  