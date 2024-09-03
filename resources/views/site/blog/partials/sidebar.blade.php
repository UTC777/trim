<div class="col-lg-4">
    <div class="widget-sidebar">
        <div class="sidebar-widget search">
            <form class="search-form">
                <input class="form-control" name="search" placeholder="Search..." type="text">
                <button class="search-button" type="submit">
                    <i class="bx bx-search"></i>
                </button>
            </form>
        </div>

        <div class="sidebar-widget categories">
            <h3>Categories</h3>
            <ul itemscope itemtype="http://schema.org/CollectionPage">
                @foreach($categories as $key => $category)
                    <li itemprop="about" itemscope itemtype="http://schema.org/Thing">
                        <a href="#" itemprop="url">
                            <span itemprop="name">{{ $category->name }}</span>
                            <i class="bx bx-chevron-right"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-widget recent-post">
            <h3 class="widget-title">Recent Posts</h3>
            <ul itemscope itemtype="http://schema.org/BlogPosting">
                @foreach($articles as $key => $article)
                    <li itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
                        <a href="{{ route('blog.show', $article->slug) }}" itemprop="url">
                            <span itemprop="headline">{{ $article->title ?? '' }}</span>
                            @if ($article->featured_image)
                                <img src="{{ $article->featured_image->getUrl() }}" alt="Image" itemprop="image">
                            @else
                                <img src="{{ asset('site/assets/images/news/news-1.jpg') }}" alt="Image" itemprop="image">
                            @endif
                        </a>
                        <span itemprop="dateModified">{{ $article->updated_at->toIso8601String() ?? '' }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-widget tags mb-0">
            <h3>Tags</h3>
            <ul itemscope itemtype="http://schema.org/Thing">
                @foreach($tags as $key => $tag)
                    <li itemprop="keywords">
                        <a href="#" itemprop="url">{{ $tag->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
