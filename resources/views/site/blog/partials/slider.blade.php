        <!-- Start Hero Slider Area -->
        <section class="hero-slider-area">
            <div class="hero-slider owl-carousel owl-theme">

                
                @foreach ($sliders as $slider)

                @if ($slider->image)
                    @php
                        $bgImg=$slider->image->getUrl('slider');
                    @endphp
                @else
                    @php
                        $bgImg=asset('site/assets/images/slider/slider-1.jpg');
                    @endphp
                @endif
                    <div class="hero-slider-item bg-1" style="background-image: url('{{ $bgImg }}')">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="container">
                                    <div class="hero-slider-content">
                                        <span>{{ $slider->sub_title }}</span>
                                        <h1>{{ $slider->main_title }}</h1>
                                        <p>{{ $slider->slider_description }}</p>
        
                                        @if ($slider->main_button_text)
                                            <div class="hero-slider-btn">
                                                <a target="_blank" href="{{ $slider->main_button_link }}" class="default-btn">
                                                    {{ $slider->main_button_text }}
                                                </a>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                

                {{-- <div class="hero-slider-item bg-2">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="hero-slider-content">
                                    <span>Welcome to Aava</span>
                                    <h1>Good Nutrition Prevent Disease</h1>
                                    <p>We advise you to cure and prevent disease with nutrition for  living your life in a healthy way Lorem ipsum dolor amet.</p>
    
                                    <div class="hero-slider-btn">
                                        <a href="about-us.html" class="default-btn">
                                            View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-slider-item bg-3">
                    <div class="d-table">
                        <div class="d-table-cell">
                            <div class="container">
                                <div class="hero-slider-content">
                                    <span>Welcome to Aava</span>
                                    <h1>Your Medicine is Your Food</h1>
                                    <p>We advise you to cure and prevent disease with nutrition for  living your life in a healthy way Lorem ipsum dolor amet.</p>
    
                                    <div class="hero-slider-btn">
                                        <a href="about-us.html" class="default-btn">
                                            View More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <!-- End Hero Slider Area -->