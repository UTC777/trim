@can('build_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.builds.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.build.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.build.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-brandModelBuilds">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.build.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.published') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.brand') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.brand_model') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.customer_company') }}
                        </th>
                        <th>
                            {{ trans('cruds.build.fields.customer_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($builds as $key => $build)
                        <tr data-entry-id="{{ $build->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $build->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $build->published ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $build->published ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $build->name ?? '' }}
                            </td>
                            <td>
                                {{ $build->brand->name ?? '' }}
                            </td>
                            <td>
                                {{ $build->brand_model->model ?? '' }}
                            </td>
                            <td>
                                @foreach($build->categories as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $build->customer_company ?? '' }}
                            </td>
                            <td>
                                {{ $build->customer_name ?? '' }}
                            </td>
                            <td>
                                @can('build_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.builds.show', $build->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('build_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.builds.edit', $build->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('build_delete')
                                    <form action="{{ route('admin.builds.destroy', $build->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('build_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.builds.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-brandModelBuilds:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection