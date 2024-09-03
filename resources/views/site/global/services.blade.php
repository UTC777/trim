@if ($services->count() > 0)
    <!-- Start What We Offer Area -->
    <section class="what-we-offer-area pt-20 pb-70 eq-height-wrap">
        <div class="container">
            <div class="section-title">
                <span>What We Offer</span>
                <h2 itemprop="about">Our Main Areas of Expertise</h2>
            </div>

            <div class="owl-carousel owl-theme what-we-offer-slider">
                @foreach ($services as $service)
                    <div class="single-what-we-offer eqheight d-flex flex-column">
                        <a href="{{ $service->link }}">
                            @if ($service->service_photo)
                                <img src="{{ $service->service_photo->getUrl('service') }}" alt="{{ $service->title }}" itemprop="image">
                            @else
                                <img src="{{ asset('site/assets/images/what-we-offer/what-we-offer-1.jpg') }}" alt="{{ $service->title }}" itemprop="image">
                            @endif
                        </a>
                        <div class="what-we-offer-content flex-grow-1 d-flex flex-column">
                            <h3>
                                <a href="{{ $service->link }}">{{ $service->title }}</a>
                            </h3>
                            <p>{!! Str::words($service->content, $limit = 35, $end = '...') !!}</p>
                            <div class="mt-auto">
                                <a href="{{ $service->link }}" class="read-more default-btn">Read More</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End What We Offer Area -->
@endif

@section('headcss')
    @parent
    <style>
    [class*="eqheight"] {display: flex; flex-direction: column; }
    [class*="eqheight"] [class*="what-we-offer-content"] {flex-grow: 1; display: flex; flex-direction: column; }
    [class*="what-we-offer-content"] [class*="mt-auto"] {margin-top: auto; }
    [class*="read-more"] {align-self: flex-start; width: auto; margin-top: auto; }
    </style>
@endsection
