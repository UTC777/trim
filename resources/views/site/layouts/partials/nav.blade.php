                        <nav class="navbar navbar-expand-md navbar-light" itemscope itemtype="http://schema.org/SiteNavigationElement">
                            <a class="navbar-brand" href="{{ url('/') }}" itemprop="url">
                                @if (isset($setting->header_logo))
                                    <!-- Using Organization schema within the logo to link it as the brand of the LocalBusiness -->
                                    <img src="{{ $setting->header_logo->getUrl() }}" alt="utahtrimclinic" itemprop="logo" itemscope itemtype="http://schema.org/Organization">
                                @endif
                            </a>

                            <div class="collapse navbar-collapse mean-menu">

                                @include('site.layouts.partials.generated-nav')
                                <div class="others-option">
                                    <div class="option-item">
                                        <i class="search-btn bx bx-search"></i>
                                        <i class="close-btn bx bx-x"></i>

                                        <div class="search-overlay search-popup">
                                            <div class='search-box'>
                                                <form class="search-form">
                                                    <input class="search-input" name="search" placeholder="Search" type="text">

                                                    <button class="search-button" type="submit">
                                                        <i class="bx bx-search"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

{{--                                    <div class="get-quote">--}}
{{--                                        <a href="" class="default-btn">--}}
{{--                                            Get Appointment--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </nav>
