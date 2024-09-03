<div class="card">
    <div class="card-header bg-gray-dark color-palette">
        {{ trans('cruds.pagesection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">

        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-pontentSection PageSectionSort">
                <thead>
                    <tr>
                        <th></th>
                        <th> {{ trans('cruds.pagesection.fields.published') }} </th>
                        <th> {{ trans('cruds.pagesection.fields.section_nickname') }} </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody id="pageSectionBody">
                    @include('admin.contentPages.partials.page-section-loop')
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="bg-danger text-light text-uppercase">
                             {{-- Important if using full-width-section do not use .m-0 class --}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

