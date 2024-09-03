        <!-- Start Header Area -->
        <header class="header-area">

            {{-- @hasSection('top-nav') --}}
                @include('site.layouts.partials.top-nav')
            {{-- @endif --}}

            <!-- Start Navbar Area -->
            <div class="navbar-area">
                <div class="mobile-nav">
                    <div class="container">
                        <div class="mobile-menu">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    @if (isset($setting->header_logo))
                                        <img src="{{ $setting->header_logo->getUrl() }}" alt="utahtrimclinic">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="desktop-nav">
                    <div class="container">
                        @include('site.layouts.partials.nav')
                    </div>
                </div>

                <div class="others-option-for-responsive">
                    <div class="container">
                        <div class="dot-menu">
                            <div class="inner">
                                <div class="circle circle-one"></div>
                                <div class="circle circle-two"></div>
                                <div class="circle circle-three"></div>
                            </div>
                        </div>

                        <div class="container">
                            <div class="option-inner">
                                <div class="others-option justify-content-center d-flex align-items-center">

                                    @include('site.layouts.partials.nav-search')


                                    <div class="get-quote">
                                        <a href="#" class="default-btn">
                                            Get Appointment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Navbar Area -->
        </header>
        <!-- End Header Area -->
