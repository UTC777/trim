            <!-- Start Top Header -->
            <div class="top-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <div class="header-left-content">
                                <ul class="contact-info">
                                    <li>
                                        <i class="bx bx-phone-call"></i>
                                        @if(isset($setting->phone))
                                            <a href="tel:{{ preg_replace("/[\s()-]/", "", $setting->phone) }}"> {{ $setting->phone }}</a>
                                        @endif
                                    </li>
                                    <li>
                                        <i class="bx bx-mail-send"></i>
                                        @if(isset($setting->email))
                                            <a href="mailto:{{ $setting->phone }}"> {{ $setting->email }}</a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="header-right-content">
                                <ul class="my-account">
{{--                                    <li> <a href="#"> <i class="bx bxs-user"></i> Account </a> </li>--}}
                                    {{-- <li> <a href="shopping-cart.html" class="basket"> <i class='bx bxs-cart-alt' ></i> Basket <span>0</span> </a> </li>  --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Top Header -->
