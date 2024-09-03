@php $itemCount = 1; @endphp
@foreach($articles as $key => $article)
    <div class="col-lg-12 col-md-6" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <meta itemprop="position" content="{{ $itemCount }}">
        <article itemprop="item" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="single-news">
                <a href="{{ route('blog.show', $article->slug) }}" itemprop="url">
                    @if ($article->featured_image)
                        <img src="{{ $article->featured_image->getUrl('featured') }}" alt="Image" itemprop="image">
                    @else
                        <img src="{{ asset('site/assets/images/news/news-5.jpg') }}" alt="Image" itemprop="image">
                    @endif
                </a>

                <div class="news-content">
                    <ul>
                        <li>
                            <i class="bx bxs-user"></i>
                            <a href="javascript:void(0);" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                <span itemprop="name">{{ $article->author ? $article->author->name : '' }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <span>{{ $article->categories->pluck('name')->first() }}</span>
                            </a>
                        </li>
                        <li>
                            <i class="bx bxs-calendar"></i>
                            <meta itemprop="dateCreated" datetime="{{ $article->created_at ?? '' }}">
                            <time itemprop="dateModified" datetime="{{ $article->updated_at ?? $article->created_at }}">{{ optional($article->updated_at ?? $article->created_at)->format('m/d/Y') }}</time>
                        </li>
                    </ul>

                    <h3 itemprop="headline">
                        <a href="{{ route('blog.show', $article->slug) }}" itemprop="url">
                            {{ $article->title ?? '' }}
                        </a>
                    </h3>
                    <div itemprop="articleBody">
                        <p itemprop="description">{{ $article->excerpt ?? '' }}</p>
                    </div>

                    <a href="{{ route('blog.show', $article->slug) }}" class="read-more" itemprop="url">
                        Read More
                    </a>
                </div>
            </div>
        </article>
    </div>
    @php $itemCount++; @endphp
@endforeach



{{--<meta itemprop="mainEntityOfPage" itemscope itemType="https://schema.org/WebPage" itemid="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="datePublished" content="{{ $article->created_at->toIso8601String() }}">--}}
{{--<meta itemprop="dateModified" content="{{ $article->updated_at->toIso8601String() }}">--}}
{{--<meta itemprop="author" itemscope itemType="https://schema.org/Person" itemid="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="publisher" itemscope itemType="https://schema.org/Organization" itemid="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="image" content="{{ $article->featured_image->getUrl() }}">--}}
{{--<meta itemprop="headline" content="{{ $article->title }}">--}}
{{--<meta itemprop="description" content="{{ $article->excerpt }}">--}}
{{--<meta itemprop="articleSection" content="{{ $article->category->name }}">--}}
{{--<meta itemprop="keywords" content="{{ $article->tags->pluck('name')->implode(', ') }}">--}}
{{--<meta itemprop="wordCount" content="{{ str_word_count(strip_tags($article->page_text)) }}">--}}
{{--<meta itemprop="url" content="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="thumbnailUrl" content="{{ $article->featured_image->getUrl() }}">--}}
{{--<meta itemprop="contentUrl" content="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="embedUrl" content="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="encodingFormat" content="text/html">--}}
{{--<meta itemprop="commentCount" content="{{ $article->comments->count() }}">--}}
{{--<meta itemprop="comment" itemscope itemType="https://schema.org/UserComments">--}}
{{--<meta itemprop="commentText" content="{{ $article->comments->pluck('comment')->implode(', ') }}">--}}
{{--<meta itemprop="commentTime" content="{{ $article->comments->pluck('created_at')->implode(', ') }}">--}}
{{--<meta itemprop="commentUrl" content="{{ route('blog.show', $article->slug) }}">--}}
{{--<meta itemprop="comment" itemscope itemType="https://schema.org/UserComments">--}}
{{--<meta itemprop="commentText" content="{{ $article->comments->pluck('comment')->implode(', ') }}">--}}
