@extends('site.layouts.app')

@section('headcss') @endsection

@section('headjs') @endsection

@section('content')

    <!-- Start Page Title Area -->
    <div class="page-title-area bg-18">
        <div class="container">
            <div class="page-title-content">
                <h2>Partner Details</h2>

                <ul itemscope itemtype="https://schema.org/BreadcrumbList">
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <a href="{{ url('') }}" itemprop="item">
                            <span itemprop="name">Home</span>
                        </a>
                        <meta itemprop="position" content="1" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                        <span itemprop="name">Pages</span>
                        <meta itemprop="position" content="2" />
                    </li>
                    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="active">
                        <span itemprop="name">Partner Details</span>
                        <meta itemprop="position" content="3" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->

    <!-- Start Partner Details Area -->
    <section class="partner-details-area ptb-100" itemscope itemtype="https://schema.org/WebPage">
        <div class="container">
            <div class="section-title">
                <h2>Partner Details</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Unde corrupti nisi dolores facere eligendi, voluptates repudiandae, dignissimos nam.</p>
            </div>

            <div class="partner-details">
                <div class="partner-single-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <img src="assets/images/partner/black-partner-1.png" alt="Image" itemprop="url">
                </div>

                <div class="partner-content">
                    <h3 itemprop="headline">Company Information</h3>
                    <p itemprop="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet dolore magna aliquyam.</p>
                </div>

                <div class="partner-content">
                    <h3 itemprop="headline">When Do We Collect information?</h3>
                    <p itemprop="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>

                <div class="partner-content">
                    <h3 itemprop="headline">How Do We Protect Your Information?</h3>
                    <p itemprop="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
                </div>

                <div class="partner-content mb-0">
                    <h3 itemprop="headline">Do We Use 'Cookies'?</h3>
                    <p itemprop="text">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet dolore magna aliquyam.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Partner Details Area -->

@endsection

@section('footjs') @endsection
