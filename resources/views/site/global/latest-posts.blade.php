@if ($latest_posts->count()>0)
    <!-- Start Our News Area -->
    <section class="our-news-area">
        <div class="container">
            <div class="section-title">
                <span>Our Blog</span>
                <h2>Latest Stories</h2>
            </div>
            <div class="owl-carousel owl-theme news-slider eq-height-wrap">
                @foreach ($latest_posts as $post)
                    <div class="single-news eqheight d-flex flex-column">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            @if ($post->featured_image)
                                <img src="{{ $post->featured_image->getUrl('featured') }}" alt="Image" itemprop="image">
                            @else
                                <img src="{{ asset('site/assets/images/news/news-5.jpg') }}" alt="Image" itemprop="image">
                            @endif
                        </a>

                        <div class="news-content flex-grow-1 d-flex flex-column">
                            <ul>
                                <li>
                                    <i class="bx bxs-user"></i>
                                    <a style="font-size:.8rem;" href="#">{{ $post->categories->pluck('name')->first() }}</a>
                                </li>
                                <li>
                                    <i class="bx bxs-calendar"></i>
                                    <span style="font-size:.8rem;">{{ date('M d, Y', strtotime($post->created_at)) }}</span>
                                </li>
                            </ul>

                            <h3>
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title ?? '' }}
                                </a>
                            </h3>

                            <p>{!! Str::words($post->excerpt, $limit = 15, $end = '...') !!}</p>

                            <div class="mt-auto">
                                <a href="{{ route('blog.show', $post->slug) }}" class="read-more default-btn">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Our News Area -->
@endif


@section('headcss')
    @parent
    <style>
    [class*="eqheight"] {display: flex!important; flex-direction: column!important; }
    [class*="eqheight"] [class*="news-content"] {flex-grow: 1!important; display: flex!important; flex-direction: column!important; }
    [class*="news-content"] [class*="mt-auto"] {margin-top: auto!important; }
    [class*="read-more"] {align-self: flex-start!important; width: auto!important; margin-top: auto!important; }
    [class*="align-self-start"] { align-self: flex-start;}
    </style>
@endsection
