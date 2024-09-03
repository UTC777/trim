<div class="form-group">
    <div class="form-check {{ $errors->has('published') ? 'is-invalid' : '' }}">
        <input type="hidden" name="published" value="0">

        @if (isset($post))
            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ $post->published || old('published', 0) === 1 ? 'checked' : '' }}>
        @else
            <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', 0) == 1 || old('published') === null ? 'checked' : '' }}>
        @endif

        <label class="form-check-label" for="published">{{ trans('cruds.post.fields.published') }}</label>
    </div>
    @if($errors->has('published'))
        <div class="invalid-feedback">
            {{ $errors->first('published') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.published_helper') }}</span>
</div>

<div class="form-group">
    <label for="author_id">{{ trans('cruds.post.fields.author') }}</label>
    <select class="form-control select2 {{ $errors->has('author') ? 'is-invalid' : '' }}" name="author_id" id="author_id" style="width: 100%;" >
        @foreach($authors as $id => $author)
        <option value="{{ $id }}" {{ (old('author_id') ? old('author_id') : $post->author->id ?? '') == $id ? 'selected' : '' }}>{{ $author }}</option>
        @endforeach
    </select>
    @if($errors->has('author'))
        <span class="text-danger">{{ $errors->first('author') }}</span>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.author_helper') }}</span>
</div>

<div class="form-group col-8">
    <label for="categories">{{ trans('cruds.post.fields.category') }}</label>
    <div class="input-group">
        <select class="form-control select2" name="categories[]" id="categories" multiple="multiple">
            @foreach($categories as $id => $name)
                <option value="{{ $id }}" {{ in_array($id, old('categories', $postCategories)) ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="addCategory">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    @if($errors->has('categories'))
        <div class="invalid-feedback">
            {{ $errors->first('categories') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.category_helper') }}</span>
</div>


<div class="form-group col-8">
    <label for="tags">{{ trans('cruds.post.fields.tag') }}</label>
    <div class="input-group">
        <select class="form-control select2" name="tags[]" id="tags" multiple="multiple">
            @foreach($tags as $id => $name)
                <option value="{{ $id }}" {{ (in_array($id, old('tags', $postTags)) ? 'selected' : '') }}>{{ $name }}</option>
            @endforeach
        </select>

        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="addTag">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    @if($errors->has('tags'))
        <div class="invalid-feedback">
            {{ $errors->first('tags') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.tag_helper') }}</span>
</div>
<div class="form-group">
    <label for="excerpt">{{ trans('cruds.post.fields.excerpt') }}</label>
    <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{{ old('excerpt', @$post->excerpt) }}</textarea>
    @if($errors->has('excerpt'))
        <div class="invalid-feedback">
            {{ $errors->first('excerpt') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.post.fields.excerpt_helper') }}</span>
</div>