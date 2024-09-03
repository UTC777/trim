<div class="col-md-6">
    <div class="accordion">
        <div class="card">
        <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4 class="card-title w-100 mb-0">
                    {{ trans('cruds.staticSeo.fields.json_ld_tag') }}
                </h4>
            </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-12">
                        <textarea class="form-control {{ $errors->has('json_ld_tag') ? 'is-invalid' : '' }}" name="json_ld_tag" id="json_ld_tag">{{ old('json_ld_tag', $staticSeo->json_ld_tag) }}</textarea>
                        @if($errors->has('json_ld_tag'))
                            <span class="text-danger">{{ $errors->first('json_ld_tag') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.staticSeo.fields.json_ld_tag_helper') }}</span>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
  </div>