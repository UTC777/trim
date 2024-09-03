		@if ($testimonials->count()>0)
            <!-- Start Testimonial Area -->
            <section class="testimonials-area pt-100">
                <div class="container">
                    <div class="testimonials-content">
                        <div class="testimonials-slider owl-carousel owl-theme eq-height-wrap">

                            @foreach ($testimonials as $testimonial)
                                <div class="single-testimonials eqheight">
                                    <i class="bx bxs-quote-right"></i>
                                    <div>{!! $testimonial->body !!}</div>

                                    <div class="writer-name">
                                        <h3>{{ $testimonial->title ?? '' }}</h3>
                                        <span>{{ $testimonial->signiture ?? '' }} {{ $testimonial->signiture_company ?? '' }}</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <h4>Testimonials</h4>
                </div>
            </section>
            <!-- End Testimonial Area -->
        @endif
