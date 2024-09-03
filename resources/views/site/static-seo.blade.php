
        @env('production')
            <!-- start jsonld -->
            {!! @$staticpageseo->json_ld_tag ?  : '' !!}

            @yield('jsonld')
            <!-- / start jsonld -->
            @if(@$staticpageseo->meta_title)
                <title>{!! @$staticpageseo->meta_title !!}</title>
                <meta property="title" content="{!! @$staticpageseo->meta_title !!}"/>
                @if(@$staticpageseo->meta_description)
                    <meta property="description" content="{!! @$staticpageseo->meta_description !!}"/>
                @endif
            @endif
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                {{-- <meta name="keywords" content=""> --}}
                <meta name="language" content="English">
                <meta name="revisit-after" content="8 days">
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            @if(@$staticpageseo->canonical)
                <link rel="canonical" href="{{ url()->current() }}">
            @endif

            @if(@$staticpageseo->noindex)
                <meta name="robots" content="noindex,follow">
            @elseif(@$staticpageseo->noindex && @$staticpageseo->nonofollow)
                <meta name="robots" content="noindex,nofollow">
            @else
                <meta name="robots" content="index,follow">
            @endif
            @if(@$staticpageseo->noarchive) <meta name="robots" content="noarchive"> @endif
            @if(@$staticpageseo->nosnippet) <meta name="robots" content="nosnippet"> @endif
            @if(@$staticpageseo->facebook_title)
                <meta property="og:site_name" content="Code">
                <meta property="og:url" content="{!! url()->current() !!}"/>
                <meta property="og:type" content="{!! @$staticpageseo->open_graph_type !!}"/>
                <meta property="og:title" content="{!! @$staticpageseo->facebook_title !!}"/>
                @if(@$staticpageseo->facebook_description)
                    <meta property="og:description" content="{!! @$staticpageseo->facebook_description !!}"/>
                @endif
            @endif
            @if(@$staticpageseo->twitter_title)
                <meta name="twitter:card" content="summary"/>
                <meta name="twitter:site" content="@utahtrimclinic"/>
                <meta name="twitter:title" content="{!! @$staticpageseo->twitter_title !!}"/>
                @if(@$staticpageseo->twitter_description)
                    <meta name="twitter:description" content="{!! @$staticpageseo->twitter_description !!}"/>
                @endif
            @endif
            @if(@$staticpageseo->noimageindex)
                <meta name="robots" content="noimageindex">
            @else
                @if(@$staticpageseo->seo_image)
                    <meta property="og:image" content="{{ @$staticpageseo->seo_image->getUrl('fb') }}"/>
                    <meta property="twitter:image" content="{{ @$staticpageseo->seo_image->getUrl('twitter') }}"/>
                    <meta itemprop="thumbnailUrl" content="{{ @$staticpageseo->seo_image->getUrl('cover') }}"/>
                    <meta itemprop="width" content="1200"/>
                    <meta itemprop="height" content="500"/>
                @else
                    <meta property="og:image" content="{{ @$staticpageseo->seo_image_url }}"/>
                    <meta property="twitter:image" content="{{ @$staticpageseo->seo_image_url }}"/>
                    <meta itemprop="thumbnailUrl" content="{{ @$staticpageseo->seo_image_url }}"/>
                    <meta itemprop="width" content="1200"/>
                    <meta itemprop="height" content="500"/>
                @endif
            @endif
        @else
            <meta name="robots" content="noindex, nofollow">
        @endenv
