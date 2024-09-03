@if(isset($page) && $page->use_svg_header == true)

    <div>
        {!! $page->svg_masthead ?? '' !!}
    </div>

@elseif(isset($page) && $page->featured_image && $page->use_featured_image_header == true)

    {{-- THIS IS FEATURED IMAGE HEADER PLACEMENT --}}
    <section class="mb-3rem page-header page-header-modern page-header-background page-header-background-md @if($page->show_title || $page->show_tagline || $page->show_featured_content) @endif"
             style="--image-url: url({{ $page->featured_image->getUrl() }}); min-height: 500px;" itemscope itemtype="https://schema.org/WebPage">
        <div class="image-box__background"></div>
        <div class="overlay"></div>
        <div class="container featured-image-container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static text-center">
                    @if ($page->show_title && $page->title)
                        <h1 class="custom-title text-capitalize font-weight-bold text-8 mb-1 {{ $page->title_style ?? '' }} mt-4 p-2" itemprop="headline">{!! $page->title ?? '' !!}</h1>
                    @endif
                    @if ($page->show_tagline && $page->sub_title)
                        <span class="custom-subtitle h4 text-uppercase text-capitalize font-weight-bold sub-title mb-1 {{ $page->tagline_style ?? 'alt-text-1 bg-dark' }} p-2" itemprop="alternativeHeadline">
                        {!! $page->sub_title ?? '' !!}
                    </span>
                    @endif
                    @if($page->show_featured_content && $page->featured_image_content)
                        <p class="custom-description text-4 mt-1 {{ $page->fi_content_style ?? 'text-light' }} p-2" itemprop="description">{!! $page->featured_image_content ?? '' !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

@elseif(isset($page) && $page->use_textonly_header == true)

    {{-- DEFAULT IF NOT FEATURED IMAGE --}}
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md" itemscope itemtype="https://schema.org/WebPage">
        <div class="container">
            <div class="row">
                <div class="col-md-12 align-self-center p-static order-2 text-center">

                    @if ($page->show_title_box)
                        @if ($page->show_title && $page->title)
                            <h1 class="font-weight-bold text-8 {{ $page->title_color ?? '' }}" itemprop="headline">{!! $page->title ?? '' !!}</h1>
                        @endif
                        @if ($page->show_tagline && $page->sub_title)
                            <span class="sub-title {{ $page->tagline_color ?? 'text-secondary' }}" itemprop="alternativeHeadline">{!! $page->sub_title ?? '' !!}</span>
                        @endif
                        @if ($page->show_featured_content && $page->featured_image_content)
                            <p class="text-4 mt-2 {{ $page->fi_content_color ?? 'text-light' }}" itemprop="description">{!! $page->featured_image_content ?? '' !!}</p>
                        @endif
                    @endif

                </div>
                <div class="col-md-12 align-self-center order-1">

                </div>
            </div>
        </div>
    </section>
@endif
