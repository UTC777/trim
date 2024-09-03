<div class="form-group" dir="ltr">
    <div class="input-group ">
        @isset($post->id)
            <span class="input-group-text no-br" id="postname-addon">
                <a target="_blank" href="{{ url('blog/'.$post->slug) }}"><i class="fas fa-link"></i></a>
            </span>
        @else
            <span class="input-group-text no-br" id="postname-addon"><i class="fas fa-unlink"></i></span>
        @endisset
            <span class="input-group-text no-br" id="slug-label">{{ url('blog') }}/</span>
            <input class="no-br col valid" name="slug" value="@if(isset($post->id)){{ $post->slug }}@endif" class="form-control"  aria-describedby="slug" />
    </div>
</div>