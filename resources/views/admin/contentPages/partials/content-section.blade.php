

<div class="m-3">
    @can('content_section_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success addContentSection" href="javascript:void(0);" data-toggle="modal" data-target="#addContentSectionModal">
            {{ trans('global.add') }} {{ trans('cruds.contentSection.title_singular') }}
        </a>
    </div>
</div>
@endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.contentSection.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-pontentSection ContentSectionSort">
                    <thead>
                        <tr>
                            <th></th>
                            <th>
                                {{ trans('cruds.contentSection.fields.published') }}
                            </th>
                            <th>
                                {{ trans('cruds.contentSection.fields.section_title') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody id="contentSectionBody">
                        @include('admin.contentPages.partials.content-section-loop')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent

<script>
$(document.body).on('click', '.DeleteContentSectionBtn' ,function(){
  $this=$(this);
    var id=$(this).attr('myid');
      var _token = $('input[name="_token"]').val();
      if (confirm('{{ trans('global.areYouSure') }}')) {
          $.ajax({
            url:"{{ url('admin/content-sections') }}/"+id,
            method:"POST",
            data: {
              id:id,_token:_token,_method: 'DELETE'
            },
            success:function(response) {
              $this.closest('tr').remove();
            }
          })
      }
  });

$(document.body).on('click', '.addContentSection' ,function(){

var _token = $('input[name="_token"]').val();
      $.ajax({
        url:'{{ url("/admin/GetPageContentSectionModalForm") }}',
        method:"POST",
        data: {_token:_token},
        success:function(response) {
          $('#addContentSectionModal .modal-content').html(response);
          $('#addContentSectionModal').modal('show');
        }
      })
});

$(document.body).on('click', '.editContentSection' ,function(){

var id=$(this).attr('myid');
var _token = $('input[name="_token"]').val();
        $.ajax({
          url:'{{ url("/admin/GetPageContentSectionModalForm") }}',
          method:"POST",
          data: {id:id,_token:_token},
          success:function(response) {
            $('#addContentSectionModal .modal-content').html(response);
            $('#addContentSectionModal').modal('show');
          }
        })
});


var myEditor;

      $(document.body).on('click', '#saveContentSection' ,function(){

        $this=$(this);
$loader='<div class="spinner-border text-dark" role="status">'+
            '<span class="sr-only">Loading...</span>'+
            '</div>';
    $this.html($loader);
    
      var pid=$('#page_id').val();
      var sectiontitle=$('#section_title').val();
      var formdata=$('#addContentSectionModal form').serialize()+'&contentPages='+pid;

      if(sectiontitle){
        var _token = $('input[name="_token"]').val();
            $.ajax({
              url:'{{ url("/admin/AddPageContentSection") }}',
              method:"POST",
              data: formdata,
              success:function(response) {
                $this.html('Save');
                $('#contentSectionBody').html(response);
                $('#addContentSectionModal').modal('hide');
                $('#addContentSectionModal form')[0].reset();
                location.reload();
              }
            })
      }
    });

</script>
@endsection