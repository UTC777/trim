<div class="tags">
    <ul class="tag-link">
        <li class="title">
            <i class="bx bxs-tag"></i>
        </li>
        @foreach($article->tags as $key => $tag)
        <li>
            <a href="#" target="_blank">
                {{ $tag->name }},
            </a>
        </li>
        @endforeach
    </ul>
    @include('site.blog.partials.show.share')
</div>
