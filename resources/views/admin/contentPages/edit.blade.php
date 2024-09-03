@extends('layouts.admin')

@section('content')

  <style>
    .media-images .removeImage {
      position: absolute;
      right: 10px;
      color: red;
    }
    body.loading .overlaymodal {
        overflow: hidden;
    }
    body.loading .overlaymodal {
      display: block;
    }
    .overlaymodal {
      display: none;
      position: fixed;
      z-index: 1000;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      background: rgba( 255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
    }
    @media (min-width: 992px)
    {
      .modal-lg{
          max-width: 100%;
        }
    }
  </style>

  <div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.contentPage.title_singular') }}
        {{-- <a class="btn btn-success float-right" href="">SEO</a> --}}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-pages.update", [$contentPage->id]) }}" enctype="multipart/form-data" id="submitPostForm" class="form-horizontal" novalidate="">
            @method('PUT')
            @csrf
            <input type="hidden" name="page_id" id="page_id" value="{{ $contentPage->id }}">
            <div class="row">

                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-right-tabContent">

                        <div class="tab-pane fade show active" id="vert-tabs-right-general" role="tabpanel" aria-labelledby="vert-tabs-right-general-tab">
                            @include('admin.contentPages.partials.title')
                            @include('admin.contentPages.partials.path')
                            <hr />
                            @include('admin.contentPages.partials.general')
                        </div>
                        <div class="tab-pane fade" id="vert-tabs-right-images"    role="tabpanel" aria-labelledby="vert-tabs-right-images-tab">
                            @include('admin.contentPages.partials.images')

                        </div>

                        <div class="tab-pane fade" id="vert-tabs-right-seo"      role="tabpanel" aria-labelledby="vert-tabs-right-seo-tab">
                            @include('admin.contentPages.partials.seo')
                        </div>

                        <div class="tab-pane fade" id="vert-tabs-right-settings" role="tabpanel" aria-labelledby="vert-tabs-right-settings-tab">

                            @include('admin.contentPages.partials.settings')
                        </div>

                        <div class="tab-pane fade" id="vert-tabs-right-content-section" role="tabpanel" aria-labelledby="vert-tabs-right-content-section-tab">
                          @includeIf('admin.contentPages.partials.content-section', ['contentSections' => $contentPage->pagesContentSections])
                        </div>

                        <div class="tab-pane fade" id="vert-tabs-right-masthead" role="tabpanel" aria-labelledby="vert-tabs-right-masthead-tab">
                          @include('admin.contentPages.partials.masthead')
                        </div>

                      <div class="tab-pane fade" id="vert-tabs-right-uploaded-media" role="tabpanel" aria-labelledby="vert-tabs-right-uploaded-media-tab">
                        @include('admin.contentPages.partials.uploaded-media')
                    </div>

                    </div>
                </div>

                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="vert-tabs-right-settings-tab" data-toggle="pill" href="#vert-tabs-right-settings" role="tab" aria-controls="vert-tabs-right-settings" aria-selected="false">DETAILS </a>
                        <a class="nav-link active" id="vert-tabs-right-general-tab" data-toggle="pill" href="#vert-tabs-right-general" role="tab" aria-controls="vert-tabs-right-general" aria-selected="true">PAGE CONTENT </a>
                         <a class="nav-link" id="vert-tabs-right-images-tab" data-toggle="pill" href="#vert-tabs-right-images" role="tab" aria-controls="vert-tabs-right-images" aria-selected="true">IMAGES</a>
                         <a class="nav-link" id="vert-tabs-right-masthead-tab" data-toggle="pill" href="#vert-tabs-right-masthead" role="tab" aria-controls="vert-tabs-right-masthead" aria-selected="false">MASTHEAD OPTIONS</a>
                        <a class="nav-link" id="vert-tabs-right-seo-tab" data-toggle="pill" href="#vert-tabs-right-seo" role="tab" aria-controls="vert-tabs-right-seo" aria-selected="false">SEO META</a>
                        <a class="nav-link" id="vert-tabs-right-content-section-tab" data-toggle="pill" href="#vert-tabs-right-content-section" role="tab" aria-controls="vert-tabs-right-content-section" aria-selected="false">NOTICES</a>
                        <a class="nav-link" id="vert-tabs-right-uploaded-media-tab" data-toggle="pill" href="#vert-tabs-right-uploaded-media" role="tab" aria-controls="vert-tabs-right-uploaded-media" aria-selected="false">UPLOADED MEDIA</a>
                    </div>
                </div>

            </div>

            <hr>

            <div class="form-group">
              <label id="errorMsg" class="error" for="title"></label> <hr>
              <button class="btn btn-success saveContent" type="button" id="save" bType="save">
                {{ trans('global.save') }}
              </button>
              <button class="btn btn-primary saveContent" id="save-and-preview" type="button">
                {{ trans('global.save_and_preview') }}
              </button>
              <button class="btn btn-danger" type="submit">
                {{ trans('global.save_and_close') }}
            </button>
          </div>
        </form>
    </div>
  </div>



  <!-- The add Content Section Modal -->
  <div class="modal" id="addContentSectionModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

      </div>
    </div>
  </div>


    <!-- The add Page Section Modal -->
  <div class="modal" id="addPageSectionModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">


            <form>
                @csrf
              <!-- Modal Header -->
              <div class="modal-header">
              <h4 class="modal-title"> Create  {{ trans('cruds.pagesection.title_singular') }}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body" style="min-height: calc(100vh - 200px);">

                <div class="card card-primary card-tabs">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-section-details-tab" data-toggle="pill" href="#custom-tabs-one-section-details" role="tab" aria-controls="custom-tabs-one-section-details" aria-selected="true">Section Details</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-section-assets-tab" data-toggle="pill" href="#custom-tabs-one-section-assets" role="tab" aria-controls="custom-tabs-one-section-assets" aria-selected="false">Section Assets</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                      <div class="tab-pane fade show active" id="custom-tabs-one-section-details" role="tabpanel" aria-labelledby="custom-tabs-one-section-details-tab">
                        <div class="form-group">
                          <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
                              <input type="hidden" name="pageSectionpublished" value="0">
                              <input class="form-check-input" type="checkbox" name="pageSectionpublished" id="pageSectionpublished" value="1" checked>
                              <label class="form-check-label" for="published">{{ trans('cruds.pagesection.fields.published') }}</label>
                          </div>
                          @if($errors->has('published'))
                              <span class="text-danger">{{ $errors->first('published') }}</span>
                          @endif
                          <span class="help-block">{{ trans('cruds.pagesection.fields.published_helper') }}</span>
                      </div>
                        <div class="form-group">
                          <div class="form-check {{ $errors->has('use_full_width_section') ? 'is-invalid' : '' }}">
                              <input type="hidden" name="pageSectionFullWidth" value="0">
                              <input class="form-check-input" type="checkbox" name="pageSectionFullWidth" id="pageSectionFullWidth" value="1" checked>
                              <label class="form-check-label" for="use_full_width_section">{{ trans('cruds.pagesection.fields.use_full_width_section') }}</label>
                          </div>
                          @if($errors->has('use_full_width_section'))
                              <span class="text-danger">{{ $errors->first('use_full_width_section') }}</span>
                          @endif
                          <span class="help-block">{{ trans('cruds.pagesection.fields.use_full_width_section_helper') }}</span>
                      </div>

                      <div class="form-group">
                          <label class="required" for="addnickname">{{ trans('cruds.pagesection.fields.section_nickname') }}</label>
                          <input class="form-control {{ $errors->has('section_nickname') ? 'is-invalid' : '' }}" type="text" name="section_nickname" id="addnickname" value="{{ old('section_nickname', '') }}">
                          @if($errors->has('section_nickname'))
                              <span class="text-danger">{{ $errors->first('section_nickname') }}</span>
                          @endif
                          <span class="help-block">{{ trans('cruds.pagesection.fields.section_nickname_helper') }}</span>
                      </div>

                      <div class="form-group">
                          <label class="required" for="sectionTitle">{{ trans('cruds.pagesection.fields.section_title') }}</label>
                          <input class="form-control {{ $errors->has('section_title') ? 'is-invalid' : '' }}" type="text" name="section_title" id="sectionTitle" value="{{ old('section_title', '') }}">
                          @if($errors->has('section_title'))
                              <span class="text-danger">{{ $errors->first('section_title') }}</span>
                          @endif
                          <span class="help-block">{{ trans('cruds.pagesection.fields.section_title_helper') }}</span>
                      </div>

                      <div class="form-group">
                          <label for="custom_class">{{ trans('cruds.pagesection.fields.custom_class') }}</label>
                          <input class="form-control {{ $errors->has('custom_class') ? 'is-invalid' : '' }}" type="text" name="custom_class" id="custom_class" value="{{ old('custom_class', '') }}">
                          @if($errors->has('custom_class'))
                              <span class="text-danger">{{ $errors->first('custom_class') }}</span>
                          @endif
                          <span class="help-block">{{ trans('cruds.pagesection.fields.custom_class_helper') }}</span>
                      </div>

                      <div class="form-group">
                        <label>{{ trans('cruds.pagesection.fields.default_section_classes') }}</label>
                        <select class="form-control {{ $errors->has('default_section_classes') ? 'is-invalid' : '' }}" name="default_section_classes" id="default_section_classes">
                            <option value disabled {{ old('default_section_classes', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach(App\Models\Pagesection::DEFAULT_SECTION_CLASSES_SELECT as $key => $label)
                                <option value="{{ $key }}" {{ old('default_section_classes', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('default_section_classes'))
                            <div class="invalid-feedback">
                                {{ $errors->first('default_section_classes') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pagesection.fields.default_section_classes_helper') }}</span>
                    </div>

                      <div class="form-group">
                        <div class="form-check {{ $errors->has('use_editor') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="use_editor" value="0">
                            <input class="form-check-input" type="checkbox" name="use_editor" id="use_editor" value="1" {{ old('use_editor', 0) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="use_editor">{{ trans('cruds.pagesection.fields.use_editor') }}</label>
                        </div>
                        @if($errors->has('use_editor'))
                            <div class="invalid-feedback">
                                {{ $errors->first('use_editor') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pagesection.fields.use_editor_helper') }}</span>
                    </div>

                      <div class="form-group" id="prismEditor">
                          <label for="addPageSectionTxt">{{ trans('cruds.pagesection.fields.section') }}</label>
                          <textarea class="prism-live line-numbers normalize-whitespace language-html  PageSectionTxt" name="prismEditor" id="addPageSectionTxt"></textarea>
                      </div>

                      <div class="form-group" id="wysiwygEditor" style="display: none;">
                        <label for="section">{{ trans('cruds.pagesection.fields.section') }}</label>
                        <textarea class="form-control ckeditor" name="wysiwygEditor" id="wysiwygEditorsection"></textarea>
                    </div>
                      </div>

                      <div class="tab-pane fade" id="custom-tabs-one-section-assets" role="tabpanel" aria-labelledby="custom-tabs-one-section-assets-tab">
                          <div class="form-group cdnbox">
                            <label for="ps_cdn_css">{{ trans('cruds.pagesection.fields.ps_cdn_css') }}</label>
                            <textarea class="prism-live cdninput normalize-whitespace language-html {{ $errors->has('ps_cdn_css') ? 'is-invalid' : '' }} ps_cdn_css" name="ps_cdn_css" id="ps_cdn_css">{{ old('ps_cdn_css', '') }}</textarea>
                            @if($errors->has('ps_cdn_css'))
                                <span class="text-danger">{{ $errors->first('ps_cdn_css') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.pagesection.fields.ps_cdn_css_helper') }}</span>
                        </div>
                          <div class="form-group cdnbox">
                            <label for="ps_cdn_js">{{ trans('cruds.pagesection.fields.ps_cdn_js') }}</label>
                            <textarea class="prism-live cdninput normalize-whitespace language-html {{ $errors->has('ps_cdn_js') ? 'is-invalid' : '' }} ps_cdn_js" name="ps_cdn_js" id="ps_cdn_js">{{ old('ps_cdn_js', '') }}</textarea>
                            @if($errors->has('ps_cdn_js'))
                                <span class="text-danger">{{ $errors->first('ps_cdn_js') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.pagesection.fields.ps_cdn_js_helper') }}</span>
                        </div>
                          <div class="form-group cdnbox">
                            <label for="ps_js">{{ trans('cruds.pagesection.fields.ps_js') }}</label>
                            <textarea class="prism-live cdninput normalize-whitespace language-javascript {{ $errors->has('ps_js') ? 'is-invalid' : '' }} ps_js" name="ps_js" id="ps_js">{{ old('ps_js', '') }}</textarea>
                            @if($errors->has('ps_js'))
                                <span class="text-danger">{{ $errors->first('ps_js') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.pagesection.fields.ps_js_helper') }}</span>
                        </div>
                          {{-- <div class="form-group cdnbox">
                            <label for="ps_css">{{ trans('cruds.pagesection.fields.ps_css') }}</label>
                            <textarea class="prism-live cdninput normalize-whitespace language-css {{ $errors->has('ps_css') ? 'is-invalid' : '' }} ps_css" name="ps_css" id="ps_css">{{ old('ps_css', '') }}</textarea>
                            @if($errors->has('ps_css'))
                                <span class="text-danger">{{ $errors->first('ps_css') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.pagesection.fields.ps_css_helper') }}</span>
                        </div> --}}
                      </div>

                    </div>
                  </div>
                  <!-- /.card -->
                </div>



              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                <input type="hidden" name="order" value="{{$contentPage->pagesPagesections->count()+1}}">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" id="addsavePageSection">Save</button>
              </div>
              </form>

    </div>
  </div>
</div>




  <!-- The add Existing Page Section Modal -->
  <div class="modal" id="addExistingPageSectionModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form>
          @csrf
         <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title"> Existing  {{ trans('cruds.pagesection.title_singular') }}</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body" style="min-height: calc(100vh - 200px);">
        <div class="form-group">
          <label for="page_sections">Select Existing Sections</label>
          {{-- <div style="padding-bottom: 4px">
              <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
              <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
          </div> --}}
          <select class="form-control select2 {{ $errors->has('page_sections') ? 'is-invalid' : '' }}" name="page_sections[]" id="page_sections" style="width: 100%;">
              @foreach($page_sections as $id => $page_section)
                @if(isset($contentPage))
                  {{-- <option value="{{ $id }}" {{ (in_array($id, old('page_sections', [])) || $contentPage->pagesPagesections->contains($id)) ? 'selected' : '' }}>{{ $page_section }}</option> --}}
                  <option value="{{ $id }}">{{ $page_section }}</option>
                @else
                  <option value="{{ $id }}" {{ in_array($id, old('page_sections', [])) ? 'selected' : '' }}>{{ $page_section }}</option>
                @endif
              @endforeach
          </select>
          @if($errors->has('page_sections'))
              <span class="text-danger">{{ $errors->first('page_sections') }}</span>
          @endif
          <span class="help-block">{{ trans('cruds.pagesection.fields.page_helper') }}</span>
      </div>
      </div>

      <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-info" id="saveExistingPageSection">Save</button>
      </div>
    </form>
      </div>
    </div>
  </div>


<!-- The add Existing Crud Section Modal -->
<div class="modal" id="addExistingCrudModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
        @csrf
       <!-- Modal Header -->
  <div class="modal-header">
    <h4 class="modal-title"> Existing Crud</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>

    <div class="modal-body" style="min-height: calc(100vh - 200px);">
      <div class="form-group">
        <label for="page_sections">Select Existing Crud</label>
        <select class="form-control select2 getpreviewimage {{ $errors->has('page_sections') ? 'is-invalid' : '' }}" name="page_sections[]" id="existing_crud" style="width: 100%;" stype="crud">
            @foreach($existing_crud as $id => $existing)
              @if(isset($contentPage))
                <option value="{{ $id }}">{{ $existing }}</option>
              @else
                <option value="{{ $id }}" {{ in_array($id, old('page_sections', [])) ? 'selected' : '' }}>{{ $existing }}</option>
              @endif
            @endforeach
        </select>
        @if($errors->has('page_sections'))
            <span class="text-danger">{{ $errors->first('page_sections') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.pagesection.fields.page_helper') }}</span>
    </div>

    <div id="crud_preview_img"></div>



    </div>

    <!-- Modal footer -->
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info" id="saveExistingCrud">Save</button>
    </div>
  </form>
    </div>
  </div>
</div>

  <div id="dummy" class="hide"></div>
@endsection

@section('scripts')
<script>
  $(document.body).on('click', '.removeImage', function() {
    $this = $(this);
    $body = $("body");

    if (confirm('Are you sure you want to remove?')) {
      $body.addClass("loading");
      var name = $this.attr('mid');
      var mtype = $this.attr('mtype');
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: '{{ url("/admin/removeMedia") }}',
        method: "POST",
        data: { name: name, type: mtype, _token: _token },
        success: function(response) {
          $this.parents('.col-sm-3').remove();
          $body.removeClass("loading");
        }
      })
    }
  });

  $('#path-segments').change(function(){
    var segments = $(this).val();
    if(segments==0){
      $('.path').hide();
      $('.path2').hide();
      $('.path3').hide();
      $('.path4').hide();
    }else if(segments==1){
      $('.path').show();
      $('.path2').hide();
      $('.path3').hide();
      $('.path4').hide();
    }else if(segments==2){
      $('.path').show();
      $('.path2').show();
      $('.path3').hide();
      $('.path4').hide();
    }else if(segments==3){
      $('.path').show();
      $('.path2').show();
      $('.path3').show();
      $('.path4').hide();
    }else if(segments==4){
      $('.path').show();
      $('.path2').show();
      $('.path3').show();
      $('.path4').show();
    }
  }).change();

  $('.changeview').click(function(){
    var type=$(this).attr('vtype');

    if(type=='list'){
      $('#list').addClass('btn-dark active');
      $('#grid').removeClass('btn-dark active');
    }else{
      $('#list').removeClass('btn-dark active');
      $('#grid').addClass('btn-dark active');
    }
  });

  $('.copyToClipboard').click(function () {
    var key = $(this).attr('key');
    let str = $(this).attr('link');
    const el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);

    var tooltip = document.getElementById("myTooltip"+key);
    tooltip.innerHTML = "Copied";
  })

  function outFunc(key) {
    var tooltip = document.getElementById("myTooltip"+key);
    tooltip.innerHTML = "Copy to clipboard";
  }

  $('.copyToClipboardFile').click(function () {
    var key = $(this).attr('key');
    let str = $(this).attr('link');
    const el = document.createElement('textarea');
    el.value = str;
    el.setAttribute('readonly', '');
    el.style.position = 'absolute';
    el.style.left = '-9999px';
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);

    var tooltip = document.getElementById("myTooltipfile"+key);
    tooltip.innerHTML = "Copied";
  })

  function outFuncFile(key) {
    var tooltip = document.getElementById("myTooltipfile"+key);
    tooltip.innerHTML = "Copy to clipboard";
  }

  $('#use_rev_slider').click(function(){
    if($(this).prop('checked') == true){
      $('#use_rev_slider_box').show();
      $('#use_textonly_header_box').hide();
      $('#use_featured_image_header_box').hide();
      $('#use_svg_header_box').hide();

      $('#use_textonly_header').prop('checked',false);
      $('#use_svg_header').prop('checked',false);
      $('#use_featured_image_header').prop('checked',false);
    }else{
      $('#use_rev_slider_box').hide();
    }
  });

  $('#use_textonly_header').click(function(){
    if($(this).prop('checked') == true){
      $('#use_textonly_header_box').show();
      $('#use_rev_slider_box').hide();
      $('#use_featured_image_header_box').hide();
      $('#use_svg_header_box').hide();

      $('#use_rev_slider').prop('checked',false);
      $('#use_svg_header').prop('checked',false);
      $('#use_featured_image_header').prop('checked',false);
    }else{
      $('#use_textonly_header_box').hide();
    }
  });

  $('#use_svg_header').click(function(){
    if($(this).prop('checked') == true){
      $('#use_featured_image_header_box').show();
      $('#use_rev_slider_box').hide();
      $('#use_textonly_header_box').hide();
      $('#use_svg_header_box').hide();

      $('#use_rev_slider').prop('checked',false);
      $('#use_textonly_header').prop('checked',false);
      $('#use_featured_image_header').prop('checked',false);
    }else{
      $('#use_featured_image_header_box').hide();
    }
  });

  $('#use_featured_image_header').click(function(){
    if($(this).prop('checked') == true){

      $('#use_featured_image_header_box').hide();
      $('#use_rev_slider_box').hide();
      $('#use_textonly_header_box').show();
      $('#use_svg_header_box').show();

      $('#use_rev_slider').prop('checked',false);
      $('#use_textonly_header').prop('checked',false);
      $('#use_svg_header').prop('checked',false);
    }else{
      $('#use_textonly_header_box').hide();
      $('#use_svg_header_box').hide();
    }
  });

  $(document.body).on('change', '.getpreviewimage' ,function(){
    var type=$(this).attr('stype');
    var id = $(this).find('option:selected').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'{{ url("/admin/getpreviewimage") }}',
      method:"POST",
      data: {id:id,_token:_token},
      success:function(response) {
        if (type=='section') {
          $('#section_preview_img').html('<img src="'+response+'" style="width: 100%;">');
        } else {
          $('#crud_preview_img').html('<img src="'+response+'" style="width: 100%;">');
        }


      }
    })
  });

  $(document.body).on('click', '#saveExistingCrud' ,function(){

    $this=$(this);
    $loader='<div class="spinner-border text-dark" role="status">'+
    '<span class="sr-only">Loading...</span>'+
    '</div>';
    $this.html($loader);

    var pid=$('#page_id').val();
// var pageSections=$("#page_sections").val();
    var existing_crud=$("#existing_crud").val();

// var page_sections = existing_crud.concat(pageSections);

// console.log(existing_crud);
    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'{{ url("/admin/AddExistingPageSection") }}',
      method:"POST",
      data: {pages:pid,page_sections:existing_crud,_token:_token},
      success:function(response) {
        $this.html('Save');
        $('#pageSectionBody').html(response);
        $('#addExistingCrudModal').modal('hide');
        $('#addExistingCrudModal form')[0].reset();
        location.reload();
      }
    })

  });

  $('.saveContent').click(function(){

    var slug=$('#slug').val();
    var path=$('#path').val();

    var is_homepage=$('#is_homepage').prop("checked");
    var bType=$(this).attr('bType');

    if (slug=='' && is_homepage==false) {
      $('#errorMsg').text('Please enter slug if it is not homepage');
    }
    // else if (path=='' && is_homepage==false) {
    //   $('#errorMsg').text('Please enter path if it is not homepage');
    // }
    else {

      $('#errorMsg').text('');

      $this=$(this);
      $loader='<div class="spinner-border text-dark" role="status">'+
      '<span class="sr-only">Loading...</span>'+
      '</div>';
      $this.html($loader);
      var formData = $('#submitPostForm').serializeArray();

      formData.push({name: 'preview', value: 1});

      $.ajax({
        type: 'POST',
        url: '{{ route("admin.content-pages.update", [$contentPage->id]) }}',
        dataType: 'json',
        data: formData,
        success: function(resultData) {

          if (resultData=='homepage') {
            var url = "{{ url('') }}";
          } else {
            var url = "{{ url('') }}"+'/'+resultData;
          }

          if (bType=='save') {
            $this.html("{{ trans('global.save') }}");
          }else{
            $this.html("{{ trans('global.save_and_preview') }}");
            window.open(url, '_blank');
          }

        }
      });

    }


  });
</script>

<script>
  $(document.body).on('blur', '#PageSectionTxt' ,function(){
    var newSrc = $('#PageSectionTxt').val();
    $('#dummy').html($('#PageSectionTxt').val());
// console.log(newSrc);
// $('#section').find('img').attr('src','hello tapas');
    $('#dummy').find("img").each(function(k, el) {
      var src=$(el).attr("src");
      var result = src.split('/');
      var lastEl = result[result.length-1];
    // console.log(lastEl);
      console.log('result',result);
      var newSrc = $(el).attr("src").replace(src, "{{ asset('site/img/landing-pages') }}/"+lastEl);
      $(el).attr("src", newSrc);
    });
    $('#PageSectionTxt').val($('#dummy').html());
  });
</script>


<script>

  $(document.body).on('click', '.clearAllExisting' ,function(){

    if (confirm('Are you sure you want to clear all existing page sections!')) {
      $this=$(this);
      $loader='<div class="spinner-border text-dark" role="status">'+
      '<span class="sr-only">Loading...</span>'+
      '</div>';
      $this.html($loader);

      var pid=$('#page_id').val();


      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:'{{ url("/admin/clearAllExistingPageSection") }}',
        method:"POST",
        data: {pages:pid,_token:_token},
        success:function(response) {
          $this.html('Clear all existing');
          $('#pageSectionBody').html(response);
          $('#addExistingPageSectionModal').modal('hide');
          $('#addExistingPageSectionModal form')[0].reset();
        }
      })
    }

  });

  $(document.body).on('click', '#saveExistingPageSection' ,function(){

    $this=$(this);
    $loader='<div class="spinner-border text-dark" role="status">'+
    '<span class="sr-only">Loading...</span>'+
    '</div>';
    $this.html($loader);

    var pid=$('#page_id').val();
    var pageSections=$('#page_sections').val();

    var _token = $('input[name="_token"]').val();
    $.ajax({
      url:'{{ url("/admin/AddExistingPageSection") }}',
      method:"POST",
      data: {pages:pid,page_sections:pageSections,_token:_token},
      success:function(response) {
        $this.html('Save');
        $('#pageSectionBody').html(response);
        $('#addExistingPageSectionModal').modal('hide');
        $('#addExistingPageSectionModal form')[0].reset();
        location.reload();
      }
    })

  });


  $(document.body).on('click', '.DeletePageSectionBtn' ,function(){
    $this=$(this);
    var id=$(this).attr('myid');
    var contentPageId=$('#page_id').val();
    var _token = $('input[name="_token"]').val();
    if (confirm('{{ trans('global.areYouSure') }}')) {
      $.ajax({
        url:"{{ route('admin.pagesections.remove_section') }}",
        method:"POST",
        data: {
          id:id,_token:_token,contentPageId: contentPageId
        },
        success:function(response) {
          $this.closest('tr').remove();
        }
      })
    }
  });

// $(document.body).on('click', '.addPageSection' ,function(){

// var _token = $('input[name="_token"]').val();
//       $.ajax({
//         url:'{{ url("/admin/GetPageSectionModalForm") }}',
//         method:"POST",
//         data: {_token:_token},
//         success:function(response) {
//           $('#addPageSectionModal .modal-content').html(response);
//           $('#addPageSectionModal').modal('show');
//         }
//       })
// });

// $(document.body).on('click', '.editPageSection' ,function(){

// var id=$(this).attr('myid');
// var _token = $('input[name="_token"]').val();
//         $.ajax({
//           url:'{{ url("/admin/GetPageSectionModalForm") }}',
//           method:"POST",
//           data: {id:id,_token:_token},
//           success:function(response) {
//             $('#addPageSectionModal .modal-content').html(response);
//             $('#addPageSectionModal').modal('show');
//           }
//         })
// });


  $(document.body).on('click', '#savePageSection' ,function(){

    $this=$(this);
    $loader='<div class="spinner-border text-dark" role="status">'+
    '<span class="sr-only">Loading...</span>'+
    '</div>';
    $this.html($loader);

    var page_section_id=$(this).attr('pid');
    var pid=$('#page_id').val();
    var nickname=$('#nickname'+page_section_id).val();
    // var PageSectionTxt=$('#PageSectionTxt'+page_section_id).val();
    var ps_cdn_css=$('#ps_cdn_css'+page_section_id).val();
    var ps_cdn_js=$('#ps_cdn_js'+page_section_id).val();
    var ps_js=$('#ps_js'+page_section_id).val();
    var ps_css=$('#ps_css'+page_section_id).val();
    var default_section_classes=$('#default_section_classes'+page_section_id).val();
    var custom_class=$('#custom_class'+page_section_id).val();

    if ($('#use_editor'+page_section_id).prop('checked')) {
      var section = $('#wysiwygEditor'+page_section_id).find('.ck-content').html();
    } else {
      var section = $('#PageSectionTxt'+page_section_id).val();
    }

    var published=0;
    if ($('#published'+page_section_id).prop("checked"))
    {
      var published=1;
    }

    var use_full_width_section=0;
    if ($('#use_full_width_section'+page_section_id).prop("checked"))
    {
      var use_full_width_section=1;
    }

    var use_editor=0;
    if ($('#use_editor'+page_section_id).prop("checked"))
    {
      var use_editor=1;
    }
    var _token = $('input[name="_token"]').val();

    var formdata={
      id:page_section_id,
      contentPages:pid,
      section:section,
      ps_cdn_css:ps_cdn_css,
      ps_cdn_js:ps_cdn_js,
      ps_js:ps_js,
      ps_css:ps_css,
      section_nickname:nickname,
      published:published,
      use_editor:use_editor,
      custom_class:custom_class,
      default_section_classes:default_section_classes,
      use_full_width_section:use_full_width_section,
      _token:_token
    };

    if(nickname){

      $.ajax({
        url:'{{ url("/admin/AddPageSection") }}',
        method:"POST",
        data: formdata,
        success:function(response) {
          $this.html('Save');
          $('#pageSectionBody').html(response);
          $('#editPageSectionModal'+page_section_id).modal('hide');
          location.reload();
        }
      })
    }
  });

  $('#use_editor').change(function(){
    if (this.checked) {
      $('#prismEditor').hide();
      $('#wysiwygEditor').show();
    } else {
      $('#prismEditor').show();
      $('#wysiwygEditor').hide();
    }
  });

  $('.use_editor').change(function(){
    var psid = $(this).attr('psid');
    if (this.checked) {
      $('#prismEditor'+psid).hide();
      $('#wysiwygEditor'+psid).show();
    } else {
      $('#prismEditor'+psid).show();
      $('#wysiwygEditor'+psid).hide();
    }
  })

  $(document.body).on('click', '#addsavePageSection' ,function(){
    $this=$(this);
    $loader='<div class="spinner-border text-dark" role="status">'+
    '<span class="sr-only">Loading...</span>'+
    '</div>';
    $this.html($loader);

    var pid=$('#page_id').val();
    var nickname=$('#addnickname').val();
    var sectionTitle=$('#sectionTitle').val();

    if ($('#use_editor').prop('checked')) {
      // var section = document.getElementsByClassName('ck-content')[0].innerHTML;
      var section = $('#wysiwygEditor').find('.ck-content').html();
    } else {
      var section = $('#addPageSectionTxt').val();
    }

    var published=0;
    if ($('#pageSectionpublished').prop("checked"))
    {
      var published=1;
    }
    var use_full_width_section=0;
    if ($('#pageSectionFullWidth').prop("checked"))
    {
      var use_full_width_section=1;
    }
    var formdata=$('#addPageSectionModal form').serialize()+'&contentPages='+pid+'&published='+published+'&use_full_width_section='+use_full_width_section+'&section='+section;

    if(nickname && sectionTitle){
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:'{{ url("/admin/AddPageSection") }}',
        method:"POST",
        data: formdata,
        success:function(response) {
          $this.html('Save');
          $('#pageSectionBody').html(response);
          $('#addPageSectionModal').modal('hide');
          $('#addPageSectionModal form')[0].reset();
          location.reload();
        }
      })
    }else{
      $this.html('Save');
    }
  });

</script>


<script>

  updateIndexPageSection = function(e, ui) {
    $('td.index', ui.item.parent()).each(function (i) {
      $(this).html(i + 1);
    });
  };
  $('.PageSectionSort tbody').sortable({
    cursor: 'move',
    axis: 'y',
    stop: updateIndexPageSection,
    update: function(e, ui) {
      $(this).sortable('refresh');
      var params = {};
      params = $('.PageSectionOrders').serializeArray();
      var pid=$('#contentPage_id').val();
  //console.log('params',params);
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:'{{ url("/admin/ChangePageSectionOrder") }}',
        method:"POST",
        data: {
          params: params,pid:pid,_token:_token
        },
        success:function(response) {

        }
      })
    }
  });

  updateIndexContentSection = function(e, ui) {
    $('td.index', ui.item.parent()).each(function (i) {
      $(this).html(i + 1);
    });
  };
  $('.ContentSectionSort tbody').sortable({
    cursor: 'move',
    axis: 'y',
    stop: updateIndexContentSection,
    update: function(e, ui) {
      $(this).sortable('refresh');
      var params = {};
      params = $('.ContentSectionOrders').serializeArray();
      var pid=$('#contentPage_id').val();
  //console.log('params',params);
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:'{{ url("/admin/ChangePageContentSectionOrder") }}',
        method:"POST",
        data: {
          params: params,pid:pid,_token:_token
        },
        success:function(response) {

        }
      })
    }
  });

</script>

<script>
  $(document).ready(function () {
    function SimpleUploadAdapter(editor) {
      editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
        return {
          upload: function() {
            return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.content-pages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';


                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

        // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $contentPage->id ?? 0 }}');
                xhr.send(data);
              });
            })
          }
        };
      }
    }

    var allEditors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(
        allEditors[i], {
          extraPlugins: [SimpleUploadAdapter]
        }
        );
    }
  });
</script>
<script>
      Dropzone.options.photosDropzone = {
        url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 10,
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 10,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
     // size: 10,
    // width: 1200,
    // height: 500
    },
    success: function (file, response) {
      $('form').find('input[name="photos"]').remove()
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photos[]"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
      @if(isset($contentPage) && $contentPage->photos)
      var file = {!! json_encode($contentPage->photos) !!}
      this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
      @endif
    },
    error: function (file, response) {
      if ($.type(response) === 'string') {
      var message = response //dropzone sends it's own error messages in string
    } else {
      var message = response.errors.file
    }
    file.previewElement.classList.add('dz-error')
    _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
    _results = []
    for (_i = 0, _len = _ref.length; _i < _len; _i++) {
      node = _ref[_i]
      _results.push(node.textContent = message)
    }

    return _results
    }
    }
</script>
<script>
      var uploadedAttachmentsMap = {}
      Dropzone.options.attachmentsDropzone = {
        url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
      uploadedAttachmentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentsMap[file.name]
      }
      $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($contentPage) && $contentPage->attachments)
      var files =
      {!! json_encode($contentPage->attachments) !!}
      for (var i in files) {
        var file = files[i]
        this.options.addedfile.call(this, file)
        file.previewElement.classList.add('dz-complete')
        $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
      }
      @endif
    },
    error: function (file, response) {
      if ($.type(response) === 'string') {
       var message = response //dropzone sends it's own error messages in string
     } else {
       var message = response.errors.file
     }
     file.previewElement.classList.add('dz-error')
     _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
     _results = []
     for (_i = 0, _len = _ref.length; _i < _len; _i++) {
       node = _ref[_i]
       _results.push(node.textContent = message)
     }

     return _results
    }
    }
</script>
<script>
      Dropzone.options.featuredImageDropzone = {
        url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 20, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif,.webp',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20,
    // width: 4096,
    // height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="featured_image"]').remove()
      $('form').append('<input type="hidden" name="featured_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="featured_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
      @if(isset($contentPage) && $contentPage->featured_image)
      var file = {!! json_encode($contentPage->featured_image) !!};

      console.log('file',file);
      this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="featured_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
      @endif
    },
    error: function (file, response) {
      if ($.type(response) === 'string') {
        var message = response //dropzone sends it's own error messages in string
      } else {
        var message = response.errors.file
      }
      file.previewElement.classList.add('dz-error')
      _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
      _results = []
      for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        node = _ref[_i]
        _results.push(node.textContent = message)
      }

      return _results
    }
    }
</script>

@endsection
