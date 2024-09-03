<hr class="solid">
<section class="section section-no-background section-height-4 border-0 pb-5 m-0 appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" style="animation-delay: 100ms;" itemscope itemtype="https://schema.org/Blog">
    <div class="container">
            <div class="recent-posts mb-5">
                <h2 class="font-weight-normal text-6 mb-4"><strong class="font-weight-extra-bold">Latest</strong> Articles</h2>
            </div>
        <div class="row justify-content-center recent-posts appear-animation animated fadeInUpShorter appear-animation-visible eq-height-wrap" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">
            @foreach($posts as $post)
            <div class="col-sm-8 col-md-4 mb-4 mb-md-0 eqheight">
                <article itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                    <meta itemprop="datePublished" content="{{date('yyy-m-d', strtotime($post->created_at)) }}">
                    <meta itemprop="dateModified" content="{{date('yyy-m-d', strtotime($post->created_at)) }}">
                    <div class="row">
                        <div class="col">
                            @if($post->featured_image)
                            <a itemprop="url" href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none" target="_blank">
                                {{-- <img itemprop="url contentUrl"  src="{{ $post->featured_image->getUrl('excerpt') }}" class="img-fluid hover-effect-2 mb-3" alt="{{$post->title ?? ''}} image"> --}}
                                {{ $post->getFirstMedia('featured_image')('responsive') }}
                            </a>
                            @else
                                <img src="https://via.placeholder.com/255/" class="img-fluid hover-effect-2 mb-3" alt="dummy image">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-color-primary text-3 mb-1"><strong>{{ @$post->categories->pluck('name')->first() }}</strong></p>
                            <h4 class="line-height-5 ls-0">
                                <a itemprop="name headline" href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                    {!! Str::words($post->title, $limit = 10, $end = '...') !!}
                                </a>
                            </h4>
                            <p class="text-color-dark opacity-7 mb-3" itemprop="description">{{ Str::limit(strip_tags(htmlspecialchars_decode($post->excerpt)), 60) }}</p>
                            <a itemprop="url" href="{{ route('blog.show', $post->slug) }}" class="read-more text-color-primary font-weight-semibold text-2 default-btn">VIEW MORE <i class="fas fa-chevron-right text-3 ml-2"></i></a>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
<hr class="solid">
