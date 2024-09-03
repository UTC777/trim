<!DOCTYPE html>
    <html lang="en" class="no-js @hasSection('htmlClasses') @yield('htmlClasses') @endif @if(@$staticpageseo) @if(@$staticpageseo->html_classes) {{ @$staticpageseo->html_classes }} @endif @endif" @if(@$staticpageseo)
    @if(@$staticpageseo->html_schema_1) itemscope itemtype="https://schema.org/{{ @$staticpageseo->html_schema_1 }}" @endif
    @if(@$staticpageseo->html_schema_2) itemtype="https://schema.org/{{ @$staticpageseo->html_schema_2 }}" @endif
    @if(@$staticpageseo->html_schema_3) itemtype="https://schema.org/{{ @$staticpageseo->html_schema_3 }}" @endif
     @endif
    >

    <head>
        @if(app()->environment() === 'production') @endif
        {{-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}

        @include('site.layouts.partials.head')

        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">

            @include('site.static-seo')

            @yield('headcss')


        @yield('headjs')

    </head>

    <body
        @hasSection('bodyData') data-plugin-page-transition="@yield('bodyData')" @endif
        @hasSection('bodyClasses') class="@yield('bodyClasses')" @else class="" @endif
                @if(@$staticpageseo->body_classes)
                    {{ @$staticpageseo->body_classes }}
                @endif
                @if(@$staticpageseo->body_schema) itemscope="" itemtype="http://schema.org/{{ @$staticpageseo->body_schema }}" @endif
        @if(@$staticpageseo->body_schema_itemid) itemid="{{ @$staticpageseo->body_schema_itemid }}" @endif
    >

        @include('site.layouts.partials.preloader')

        @include('site.layouts.partials.header')


        <div role="main" class="@yield('main-classes') @if(@$staticpageseo) @if(@$staticpageseo->main_classes) {{ @$staticpageseo->main_classes }} @endif @endif">
            @yield('page-title-section')
            @yield('masthead')

            @include('site.layouts.partials.top_sections')

            @yield('above-content')

                @yield('content')

            @yield('below-content')

            @include('site.layouts.partials.bottom_sections')
        </div>

        @include('site.layouts.partials.footer')
        @include('site.layouts.partials.copy-right')

        <!-- Start Go Top Area -->
        <div class="go-top">
            <i class="bx bx-chevrons-up"></i>
            <i class="bx bx-chevrons-up"></i>
        </div>
        <!-- End Go Top Area -->

        @include('site.layouts.partials.core-scripts')

        @yield('footjs')

        <script>
            $(document).ready(function(){
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 2
                        },
                        1000: {
                            items: 3
                        }
                    }
                });

                // Equal height function call
                equalHeight('[class*="eqheight"]');
            });

            $(window).resize(function () {
                equalHeight('[class*="eqheight"]');
            });

            function equalHeight(columnClass) {
                $('.eq-height-wrap').imagesLoaded(function () {
                    $('.eq-height-wrap').each(function () {

                        $(this).find(columnClass).css('height', 'auto');

                        var maxHeight = Math.max.apply(null, $(this).find(columnClass).map(function () {
                            return $(this).innerHeight();
                        }).get());

                        $(this).find(columnClass).height(maxHeight);
                    });
                });
            }
        </script>
    </body>
</html>
