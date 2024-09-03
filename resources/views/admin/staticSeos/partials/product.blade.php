{{-- product section only  --}}
@if ($staticSeo->content_type=='product')
    <div class="form-group">
        <label for="product_id">{{ trans('cruds.staticSeo.fields.product') }}</label>
        <select class="form-control select2 {{ $errors->has('product') ? 'is-invalid' : '' }}" name="product_id" id="product_id">
            @foreach($products as $id => $entry)
                <option value="{{ $id }}" {{ (old('product_id') ? old('product_id') : $staticSeo->product->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
            @endforeach
        </select>
        @if($errors->has('product'))
            <span class="text-danger">{{ $errors->first('product') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.product_helper') }}</span>
    </div>
@endif
{{-- product section only  --}}