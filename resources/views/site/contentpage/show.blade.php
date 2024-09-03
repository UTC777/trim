@extends('site.layouts.app')

{{-- added this part for custom css for this page only. --}}
@section('headcss')
    @parent
    <style>
        @if (isset($page->custom_css))
            {!! $page->custom_css !!}
        @endif

        [class*="br-10"] {border-radius:10px!important;}
        [class*="chatbg-1"] { background: #d0eeff!important;}
        [class*="chatbg-2"] { background: #ffefd8!important;}
        [class*="page-header"] {
            position: relative;
        }
        [class*="page-header"] .image-box__background,
        [class*="page-header"] .overlay {
            position: absolute;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
        }
        [class*="page-header"] .image-box__background {
            background: var(--image-url) center center no-repeat;
            background-size: cover;
            z-index: 1;
        }
        [class*="page-header"] .overlay {
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }
        [class*="page-header"] .custom-title,
        [class*="page-header"] .custom-subtitle,
        [class*="page-header"] .custom-description {
            position: relative;
            z-index: 3;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        [class*="page-header"] .custom-title {  margin-top: 6rem!important; }
        [class*="page-header"] .custom-subtitle {  margin-top: 20px; }

    </style>
@endsection

@section('masthead')

    @if ($page->use_rev_slider==1)
        @if ($page->sliders->count()>0)
            @include('site.contentpage.partials.hero-slider')
        @endif
    @else
        @include('site.contentpage.partials.masthead')
    @endif

@endsection

@section('above-content')

    @if(isset($page->pagesFrontContentSections))
        @foreach($page->pagesFrontContentSections as $ts)
            @if ($ts->location=='content_top')
                {!! $ts->section !!}
            @endif
        @endforeach
    @endif

@endsection

@section('content')

    <!-- #wrapper-content start -->
    <div id="wrapper-content" class="wrapper-content pt-11 pb-13 body">
    <div class="container">
        <div id="pageSectionDiv">
            @if($page)
                @foreach($page->pagesFrontPagesections as $ps)
                    <div class="ps-wrapper-{{ $ps->id }} {{ $ps->custom_class }} {{ $ps->default_section_classes }} {{ \Str::slug($ps->section_nickname, '-') }} @if($ps->use_full_width_section==1) full-width-section @endif">

                    @if($ps->ps_css)
                        @section('headcss')
                            @parent
                            {!! $ps->ps_cdn_css !!}
                            <style>
                                {!! $ps->ps_css !!}
                            </style>
                        @endsection
                    @endif

                    @if ($ps->use_crud_section==1)

                        @if ($ps->select_crud_section==1)
                            @includeIf('site.global.latest-posts', ['latest_posts' => $latest_posts])
                        @endif

                        @if ($ps->select_crud_section==2)
                            @includeIf('site.global.testimonials', ['testimonials' => $testimonials])
                        @endif

                        @if ($ps->select_crud_section==3)
                            @includeIf('site.global.success-stories', ['success_stories' => $success_stories])
                        @endif

                        @if ($ps->select_crud_section==4)
                            @includeIf('site.global.seenons', ['seenons' => $seenons])
                        @endif

                        @if ($ps->select_crud_section==5)
                            @includeIf('site.global.services', ['services' => $services])
                        @endif

                    @else
                    <div id="ps-section">
                        {!! $ps->section !!}
                    </div>

                    @endif

                    @if($ps->ps_js)
                        @section('footjs')
                            @parent
                            {!! $ps->ps_cdn_js !!}
                            <script>
                                {!! $ps->ps_js !!}
                            </script>
                        @endsection
                    @endif
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection

@section('below-content')

    {{-- THIS IS FOR BELOW CONTENT > CONTENT SECTION FOR PAGES CRUD --}}

    @if(isset($page->pagesFrontContentSections))
        @foreach($page->pagesFrontContentSections as $ts)
            @if ($ts->location=='content_bottom')
                {!! $ts->section !!}
            @endif
        @endforeach
    @endif

@endsection

@section('footjs')
    @parent
    <script>
        // $( document ).ready(function() {
        //     $('#ps-section').find("img").each(function(k, el) {
        //         var src=$(el).attr("src");
        //         var result = src.split('/');
        //         var lastEl = result[result.length-1];

        //         var newSrc = $(el).attr("src").replace(src, "{{ asset('site/img/landing-pages') }}/"+lastEl);
        //         $(el).attr("src", newSrc);

        //     });
        // });
    </script>


    <script>
        function isEven(num) {
            if (num !== false && num !== true && !isNaN(num)) {
                return num % 2 == 0;
            } else {
                return false;
            }
        }

        function fullWidth(elementName, containerWidth) {

            // console.log("=======================================================");
            // console.log("%c INSIDE FULLWIDTH() ", 'background: #000; color: yellow');

            var window_width = $(window).width();
            console.log("window_width: " + window_width);
            var containerWidth = $('div.body .container').width();
            console.log("containerWidth: " + containerWidth);

            // Determine whether to round up or not for odd widths
            if (isEven(window_width) !== false) {
                var left_margin = -((window_width - containerWidth) / 2);
            } else {
                var left_margin = -(Math.ceil((window_width - containerWidth) / 2));
            }

            if (window_width > containerWidth) {
                //  elementName.width(window_width).css({ marginLeft: left_margin });
                elementName.width(window_width).css('cssText', function(i, v) {
                    return this.style.cssText + ';margin-left: ' + left_margin + 'px!important;';
                });

            } else if (window_width < containerWidth) {
                elementName.css({ width: '100%' }, { marginLeft: '0' });
            }
            widthHorz = $(window).width();

            $(window).bind('resize', function(e) {
                if (widthHorz != $(window).width()) {
                    var new_window_width = $(window).width();
                    // Determine whether to round up or not for odd widths
                    if (isEven(new_window_width) !== false) {
                        var new_left_margin = -((new_window_width - containerWidth) / 2);
                    } else {
                        var new_left_margin = -(Math.ceil((new_window_width - containerWidth) / 2));
                    }

                    if (new_window_width > containerWidth) {
                        //  elementName.width(new_window_width).css({ marginLeft: new_left_margin });
                        elementName.width(new_window_width).css('cssText', function(i, v) {
                            return this.style.cssText + ';margin-left: ' + new_left_margin + 'px!important;';
                        });

                    } else if (new_window_width < containerWidth) {
                        elementName.css({ width: '100%' }, { marginLeft: '0' });

                    } else {
                        elementName.css({ width: '100%' }, { marginLeft: '0' });
                    }
                }
            });
        }

        function fullWidthRun() {
            var site_width = $(window).width();
            var current_body = $('body');
            // fullWidth($('.full-width-section'), site_width);
            fullWidth($('[class*="full-width-section"]'), site_width);
        }
        fullWidthRun();
    </script>
@endsection

@section('jsonld')

    @if ($setting->header_logo)
        @php
            $logo=$setting->header_logo->getUrl();
        @endphp
        @else
        @php
            $logo='';
        @endphp
    @endif

    @php
        $currentUrl = url()->current();
    @endphp
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@graph": [
        {
          "@type": "WebPage",
          "@id": "{{ $currentUrl }}",
          "url": "{{ $currentUrl }}",
          "name": "{{ $page->title ?? '' }} - Utah Trim Clinic",
          "isPartOf": {
            "@id": "{{ url('') }}/#website"
          },
          "primaryImageOfPage": {
            "@id": "{{ $currentUrl }}/#primaryimage"
          },
          "image": {
            "@id": "{{ $currentUrl }}/#primaryimage"
          },
          "thumbnailUrl": "{{ $staticpageseo->seo_image_url ?? '' }}",
          "datePublished": "{{ $page->created_at ?? '' }}",
          "dateModified": "{{ $page->updated_at ?? '' }}",
          "breadcrumb": {
            "@id": "{{ $currentUrl }}/#breadcrumb"
          },
          "inLanguage": "en-US",
          "potentialAction": [
            {
              "@type": "ReadAction",
              "target": [
                "{{ $currentUrl }}"
              ]
            }
          ]
        },
        {
          "@type": "ImageObject",
          "inLanguage": "en-US",
          "@id": "{{ $currentUrl }}/#primaryimage",
          "url": "{{ $staticpageseo->seo_image_url ?? '' }}",
          "contentUrl": "{{ $staticpageseo->seo_image_url ?? '' }}"
        },
        {
          "@type": "BreadcrumbList",
          "@id": "{{ $currentUrl }}/#breadcrumb",
          "itemListElement": [
            {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "{{ url('') }}"
            },
            {
              "@type": "ListItem",
              "position": 2,
              "name": "3-D Body Scanner"
            }
          ]
        },
        {
          "@type": "WebSite",
          "@id": "{{ url('') }}/#website",
          "url": "{{ url('') }}",
          "name": "Utah Trim Clinic",
          "description": "{{ $staticpageseo->meta_description ?? '' }}",
          "publisher": {
            "@id": "{{ url('') }}/#organization"
          },
          "potentialAction": [
            {
              "@type": "SearchAction",
              "target": {
                "@type": "EntryPoint",
                "urlTemplate": "{{ url('') }}/?s={search_term_string}"
              },
              "query-input": "required name=search_term_string"
            }
          ],
          "inLanguage": "en-US"
        },
        {
          "@type": "Organization",
          "@id": "{{ url('') }}/#organization",
          "name": "Utah Trim Clinic",
          "url": "{{ url('') }}",
          "logo": {
            "@type": "ImageObject",
            "inLanguage": "en-US",
            "@id": "{{ url('') }}/#/schema/logo/image/",
            "url": "{{ $logo }}",
            "contentUrl": "{{ $logo }}",
            "width": 316,
            "height": 89,
            "caption": "Utah Trim Clinic"
          },
          "image": {
            "@id": "{{ url('') }}/#/schema/logo/image/"
          }
        }
      ]
    }
    </script>

@endsection
