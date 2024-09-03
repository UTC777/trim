        <!-- Start Hero Slider Area -->
        <section class="hero-slider-area">
            <div class="hero-slider owl-carousel owl-theme">


                @foreach ($page->sliders as $slider)

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
                                        @if($slider->sub_title)
                                        <span @style($slider->sub_title_css)>{{ $slider->sub_title }}</span>
                                        @endif
                                        @if($slider->main_title)
                                        <h1 @style($slider->main_title_css)>{{ $slider->main_title }}</h1>
                                        @endif
                                            @if($slider->sub_title_2)
                                                <span @style($slider->sub_title_2_css)>{{ $slider->sub_title_2 }}</span>
                                            @endif
                                            @if($slider->slider_description)
                                            <div class="slider-description">
                                                <p class="text-heading" @style($slider->text_heading_css)>
                                                    @if($slider->heading_1)
                                                        <span class="heading-1 h2" @style($slider->heading_1_css)>{{ $slider->heading_1 }}</span> <br>
                                                    @endif
                                                    @if($slider->heading_2)
                                                        <span class="heading-2 h3" @style($slider->heading_2_css)>{{ $slider->heading_2 }}</span> <br>
                                                    @endif
                                                    @if($slider->heading_3)
                                                        <span class="heading-3 h4" @style($slider->heading_3_css)>{{ $slider->heading_3 }}</span> <br>
                                                    @endif
                                                </p>
                                                @if($slider->slider_description)
                                                    <p @style($slider->slider_description_css)>{{ $slider->slider_description }}</p>
                                                @endif
                                            </div>
                                            @endif
                                            @if($slider->text)
                                                <div class="slider-text" @style($slider->text_css)>
                                                    {!! $slider->text !!}
                                                </div>
                                            @endif

                                        @if ($slider->main_button_text)
                                            <div class="hero-slider-btn">
                                                <a target="_blank" href="{{ $slider->main_button_link }}" @style($slider->main_button_css) class="default-btn">
                                                    @if($slider->main_button_icon_class) <i @class($slider->main_button_icon_class)></i> @endif
                                                    {{ $slider->main_button_text }}
                                                </a>
                                            </div>
                                        @endif
                                        @if($slider->second_button_text)
                                            <div class="hero-slider-btn">
                                                <a target="_blank" href="{{ $slider->second_button_link }}" @style($slider->second_button_css) class="secondary-btn">
                                                    @if($slider->second_button_icon_class) <i @class($slider->second_button_icon_class)></i> @endif
                                                    {{ $slider->second_button_text }}
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
