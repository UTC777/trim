@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area bg-2">
        <div class="container">
            <div class="page-title-content">
                <h2>Client Success Stories</h2>
                <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ url('') }}" itemprop="item">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">
                        <span itemprop="name">Success Stories</span>
                        <meta itemprop="position" content="2" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Portfolio Area -->
    <div class="portfolio-area ptb-10 mt-3" itemscope itemtype="https://schema.org/ItemList">
        <div class="container story-list">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Transformations That Inspire</h3>
                    <p>At Utah Trim Clinic, we're dedicated to helping our clients achieve their health and wellness goals. Here are some of the
                        incredible success stories from our clients who have transformed their lives through our programs.</p>
                    <div class="shorting-menu">
                        <button class="filter" data-filter="all">
                            All
                        </button>

                        @foreach ($categories as $category)
                            <button class="filter" data-filter=".{{ $category->slug }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                @php $itemCount = 1; @endphp
                @foreach($stories as $story)
                    @if($story->use_before_after && $story->hasMedia('before') && $story->hasMedia('after'))
                        <div class="col-lg-6 col-md-6 mix {{ $story->story_category->slug ?? '' }}" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <meta itemprop="position" content="{{ $itemCount }}">
                            <a href="{{ route('success-stories.show', $story->slug) }}" class="single-portfolio d-flex justify-content-between" itemprop="url">
                                <div style="flex: 1; padding: 0 10px;">
                                    <img src="{{ $story->getFirstMediaUrl('before', 'responsive') }}" alt="Before" style="width: 100%;" itemprop="image">
                                </div>
                                <div style="flex: 1; padding: 0 10px;">
                                    <img src="{{ $story->getFirstMediaUrl('after', 'responsive') }}" alt="After" style="width: 100%;" itemprop="image">
                                </div>
                            </a>
                        </div>
                    @elseif($story->use_combined && $story->hasMedia('combined'))
                        <div class="col-lg-6 col-md-6 mix {{ $story->story_category->slug ?? '' }}" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <meta itemprop="position" content="{{ $itemCount }}">
                            <a href="{{ route('success-stories.show', $story->slug) }}" class="single-portfolio d-flex justify-content-center" style="padding: 20px;" itemprop="url">
                                <img src="{{ $story->getFirstMediaUrl('combined', 'responsive') }}" alt="Combined" style="max-width: 100%; height: auto;" itemprop="image">
                            </a>
                        </div>
                    @else
                        <div class="col-lg-6 col-md-6 mix {{ $story->story_category->slug ?? '' }}" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <meta itemprop="position" content="{{ $itemCount }}">
                            <a href="{{ route('success-stories.show', $story->slug) }}" class="single-portfolio" itemprop="url">
                                <img src="{{ asset('site/assets/images/No_Image_Available.jpg') }}" alt="No images available" style="max-width: 100%; height: auto;" itemprop="image">
                            </a>
                        </div>
                    @endif
                    @php $itemCount++; @endphp
                @endforeach
            </div>
        </div>


        <div class="container mt-5">
            <iframe width="1220" height="686" src="https://www.youtube.com/embed/Yv1zeKHpXbI" title="Utah trim Clinic Patient Testimonial"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
        </div>




    </div>
    <!-- End Portfolio Area -->

@endsection

@section('footjs')
    <script>
        $(function() {
            var containerEl = document.querySelector('.story-list');
            var mixer = mixitup(containerEl);
        });

        $(document).on('click', '.filter', function () {
            $('.filter').removeClass('active');
            $(this).addClass('active');
        });
    </script>
@endsection
