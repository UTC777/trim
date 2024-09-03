        <!-- Start Footer Area -->
        <footer class="footer-area pt-20 pb-70 @if($staticpageseo) @if($staticpageseo->footer_classes) {{ $staticpageseo->footer_classes }} @endif @endif" itemscope itemtype="http://schema.org/LocalBusiness">
            <div class="container">
                <div class="row mt-5 pt-5">
                    <div class="col-lg-3 col-md-6" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <div class="single-footer-widget">
                            <a href="{{ url('/') }}" class="logo">
                                @if (isset($setting->footer_logo))
                                    <img src="{{ $setting->footer_logo->getUrl() }}" alt="utahtrimclinic" itemprop="url" style="max-width:15rem;height:auto;">
                                @endif
                            </a>

                            <ul class="open-close">
                                <li>
                                    <span>Opening Hours:</span>
                                </li>
                                <meta itemprop="openingHours" content="{!! $setting->opening_hours ?? '' !!}">
                                {!! $setting->opening_hours ?? '' !!}
                            </ul>

                            <ul class="social-icon">
                                <li>
                                    <span>Follow Us:</span>
                                </li>
                                @if (isset($setting->facebook_link))
                                    <li>
                                        <a href="{{ $setting->facebook_link }}" target="_blank">
                                            <i class="bx bxl-facebook"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (isset($setting->instagram_link))
                                    <li>
                                        <a href="{{ $setting->instagram_link }}" target="_blank">
                                            <i class="bx bxl-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (isset($setting->instagram_link))
                                    <li>
                                        <a href="{{ $setting->instagram_link }}" target="_blank">
                                            <i class="bx bxl-instagram"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (isset($setting->linkedin_link))
                                    <li>
                                        <a href="{{ $setting->linkedin_link }}" target="_blank">
                                            <i class="bx bxl-linkedin"></i>
                                        </a>
                                    </li>
                                @endif
                                @if (isset($setting->twitter_link))
                                    <li>
                                        <a href="{{ $setting->twitter_link }}" target="_blank">
                                            <i class="bx bxl-twitter"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget" itemscope itemtype="http://schema.org/ContactPoint">
                            <h3>Contact Us</h3>

                            <ul class="address">
                                <li class="location" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                                    <i class="bx bx-location-plus"></i>
                                    <span itemprop="streetAddress">{{ $setting->address ?? '' }}</span>
                                </li>
                                <li>
                                    <i class="bx bx-envelope"></i>
                                    <a href="mailto:{{ $setting->email ?? '' }}" itemprop="email">{{ $setting->email ?? '' }}</a>
                                </li>
                                <li>
                                    <i class="bx bx-phone"></i>
                                    @if (isset($setting->phone))
                                        <a href="tel:{{ preg_replace("/[\s()-]/", "", $setting->phone) }}" itemprop="telephone">{{ $setting->phone }}</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Quick Links</h3>
                            @if(isset($footer_menu))
                                <ul class="import-link" itemscope itemtype="http://schema.org/SiteNavigationElement">
                                        @foreach($footer_menu as $menu)
                                            <li>
                                                <a href="{{  preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode(strpos($menu['link'], "http") === 0 ? $menu['link'] : url('',$menu['link']))) }}" title="{{ $menu['label'] }}"  itemprop="url">{{ $menu['label'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Newsletter</h3>
                            <p>Sign up to get new exclusive offers from our latest news.</p>

                            <form class="newsletter-form" data-toggle="validator">
                                <input type="email" class="form-control" placeholder="Your email address" name="EMAIL" required autocomplete="off">

                                <button class="default-btn" type="submit">
                                    Subscribe Now
                                </button>

                                <div id="validator-newsletter" class="form-result"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
