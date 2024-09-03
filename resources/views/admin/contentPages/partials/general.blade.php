
        <hr class="mb-3">

            @if (isset($contentPage))
            <div class="form-group">
                <label> </label>
                @can('pagesection_create')
                    <div class="float-right">
                        <a class="btn btn-success btn-xs addPageSection" href="javascript:void(0);" data-toggle="modal" data-target="#addPageSectionModal">
                            {{ trans('global.add') }} {{ trans('cruds.pagesection.title_singular') }}
                        </a>
                        <a class="btn btn-success btn-xs addExistingPageSection" href="javascript:void(0);" data-toggle="modal" data-target="#addExistingPageSectionModal">
                            {{ trans('global.add') }} Existing Sections
                        </a>
                        <a class="btn btn-success btn-xs addExistingCrud" href="javascript:void(0);" data-toggle="modal" data-target="#addExistingCrudModal">
                            {{ trans('global.add') }} Existing Crud
                        </a>
                        <a class="btn btn-danger btn-xs clearAllExisting" href="javascript:void(0);">
                            Clear all existing
                        </a>
                    </div>

                @endcan
            </div>

            <div class="col">

                @includeIf('admin.contentPages.partials.page-section', ['pageSections' => $contentPage->pagesPagesections])

                <span class="help-block">SECTIONS ARE DRAG AND DROP</span> <br>
                <span class="help-block"><small>Use this class in section tag to make full width and make section ignore boxed style.  &nbsp; .full-width-section </small></span> <br>
            </div>
            @else
            <h1>Sections Can Only Be Added on Edit</h1>
            @endif

            <hr>


            @if (@$contentPage)
                <div class="form-group">
                    <label for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
                    <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt', @$contentPage->excerpt) }}</textarea>
                    @if($errors->has('excerpt'))
                        <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
                </div>
            @endif
