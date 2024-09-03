 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h4 class="card-title">Uploaded Media</h4>
            </div>
            <div class="card-body">
              <div class="row uploaded-media">

                {{-- <div class="list-grid-button">
                  <button type="button" class="btn btn-default changeview" vtype="list" id="list"><i class="fa fa-bars"></i> List</button> 
                  <button type="button" class="btn btn-default active changeview" vtype="grid" id="grid"><i class="fa fa-th-large"></i> Grid</button>
                </div> --}}

                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-photos-tab" data-toggle="pill" href="#custom-tabs-one-photos" role="tab" aria-controls="custom-tabs-one-photos" aria-selected="true">Photos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-attachments-tab" data-toggle="pill" href="#custom-tabs-one-attachments" role="tab" aria-controls="custom-tabs-one-attachments" aria-selected="false">Attachments</a>
                  </li>
                </ul>

                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-photos" role="tabpanel" aria-labelledby="custom-tabs-one-photos-tab">
                    <div class="row">
                    
                    @foreach ($photos as $key => $photo)
                    <div class="col-sm-3">
                      <div class="media-images">
                        <a href="{{ asset('site/img/landing-pages/'.$photo['filename']) }}" data-toggle="lightbox" data-title="{{ $photo['filename'] }}" data-gallery="gallery">
                          <img src="{{ asset('site/img/landing-pages/'.$photo['filename']) }}" class="img-fluid mb-2" alt="{{ $photo['filename'] }}"/>
                        </a>
                        <span class="tooltiptextimg" id="myTooltipName{{ $key }}">{{ $photo['filename'] }}</span>
                        <div class="copy-btn">
                          <button type="button" title="Copy Link" class="btn btn-info copyToClipboard" link="{{ asset('site/img/landing-pages/'.$photo['filename']) }}" onmouseout="outFunc({{ $key }})" key="{{ $key }}"> <span class="tooltiptext" id="myTooltip{{ $key }}">Copy to clipboard</span> Copy Link</button>
                        </div>
                        <a href="javascript:void(0);" class="removeImage" mtype="photo" mid="{{ $photo['filename'] }}">
                          <i class="fa fa-trash"></i>
                        </a>
                      </div>
                    </div>
                  @endforeach
                  </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-attachments" role="tabpanel" aria-labelledby="custom-tabs-one-attachments-tab">
                    <div class="row">
                      @foreach ($attachments as $akey => $attachment)
                      <div class="col-sm-3">
                        <div class="media-images">
                          <a href="{{ asset('site/img/filetext-large.jpg') }}" data-toggle="lightbox" data-title="{{ $attachment['filename'] }}" data-gallery="gallery">
                            <img src="{{ asset('site/img/filetext.jpg') }}" class="img-fluid mb-2" alt="{{ $attachment['filename'] }}"/>
                          </a>
                          <span class="tooltiptextimg" id="myTooltipfilename{{ $akey }}">{{ $attachment['filename'] }}</span>
                          <div class="copy-btn">
                            <button type="button" title="Copy Link" class="btn btn-info copyToClipboardFile" link="{{ asset('site/attachments/landing-pages/'.$attachment['filename']) }}" onmouseout="outFuncFile({{ $akey }})" key="{{ $akey }}"> <span class="tooltiptext" id="myTooltipfile{{ $akey }}">Copy to clipboard</span> Copy Link</button>
                          </div>
                          <a href="javascript:void(0);" class="removeImage" mtype="attachment" mid="{{ $attachment['filename'] }}">
                            <i class="fa fa-trash"></i>
                          </a>
                        </div>
                      </div>
                    @endforeach
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->