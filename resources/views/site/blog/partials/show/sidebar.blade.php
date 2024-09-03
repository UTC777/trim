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
            <ul itemscope itemtype="http://schema.org/ItemList">
                @foreach($article->categories as $key => $category)
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a href="#" itemprop="url">
                            <span itemprop="name">{{ $category->name }}</span>
                            <i class="bx bx-chevron-right"></i>
                        </a>
                        <meta itemprop="position" content="{{ $loop->iteration }}" />
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-widget recent-post">
            <h3 class="widget-title">Recent Posts</h3>
            <ul itemscope itemtype="http://schema.org/ItemList">
                @foreach($articles as $key => $article)
                    <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <a href="news-details.html" itemprop="url">
                            <span itemprop="name">{{ $article->title ?? '' }}</span>
                            @if ($article->featured_image)
                                <img src="{{ $article->featured_image->getUrl() }}" alt="Image" itemprop="image">
                            @endif
                        </a>
                        <meta itemprop="position" content="{{ $loop->iteration }}" />
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="sidebar-widget tags mb-0">
            <h3>Tags</h3>
            <ul itemscope itemtype="http://schema.org/ItemList">
                @if ($article->tags->count()>0)
                    @foreach($article->tags as $key => $tag)
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a href="#" itemprop="url">
                                <span itemprop="name">{{ $tag->name }}</span>
                            </a>
                            <meta itemprop="position" content="{{ $loop->iteration }}" />
                        </li>
                    @endforeach
                @endif
                
            </ul>
        </div>
    </div>
</div>
