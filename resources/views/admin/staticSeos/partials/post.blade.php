{{-- post section only  --}}
@if ($staticSeo->content_type=='post')
    <div class="form-group">
        <label for="post_id">{{ trans('cruds.staticSeo.fields.post') }}</label>
        <select class="form-control select2 {{ $errors->has('post') ? 'is-invalid' : '' }}" name="post_id" id="post_id">
            @foreach($posts as $id => $entry)
                <option value="{{ $id }}" {{ (old('post_id') ? old('post_id') : $staticSeo->post->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
            @endforeach
        </select>
        @if($errors->has('post'))
            <span class="text-danger">{{ $errors->first('post') }}</span>
        @endif
        <span class="help-block">{{ trans('cruds.staticSeo.fields.post_helper') }}</span>
    </div>
@endif
{{-- post section only  --}}
