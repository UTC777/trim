@extends('site.layouts.app')

@section('headcss')
    <style>
        [class*="hero-slider-item"].bg-1 { border: 1px solid black!important; }
        .eqheight { display: flex; flex-direction: column; }
        .eqheight .news-content { flex-grow: 1; display: flex; flex-direction: column; }
        .news-content .mt-auto { margin-top: auto; }
    </style>
@endsection

@section('headjs') @endsection

@section('content')

    @include('site.blog.partials.top-section')
    @include('site.blog.partials.slider')
    <section class="news-list-area" itemscope itemtype="http://schema.org/ItemList">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row eq-height-wrap">
                        @foreach($articles as $article)
                            <article itemscope itemtype="http://schema.org/BlogPosting" class="col-lg-12 col-md-6">
                                <div class="single-news eqheight d-flex flex-column">
                                    <div class="news-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                        @if($article->featured_image)
                                            <img src="{{ $article->featured_image->getUrl('featured') }}" alt="Image" itemprop="url">
                                            <meta itemprop="width" content="800">
                                            <meta itemprop="height" content="600">
                                        @endif
                                    </div>
                                    <div class="news-content eqheight flex-grow-1 d-flex flex-column">
                                        <ul class="admin">
                                            @if($article->author)
                                                <li>
                                                    <a href="javascript:void(0);" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                                        <i class="bx bxs-user"></i>
                                                        <span itemprop="name">{{ $article->author ? $article->author->name : '' }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <i class="bx bx-calendar"></i>
                                                <time itemprop="datePublished" datetime="{{ $article->created_at->toIso8601String() }}">
                                                    {{ optional($article->updated_at ?? $article->created_at)->format('m/d/Y') }}
                                                </time>
                                            </li>
                                        </ul>
                                        <h3 itemprop="headline">
                                            <a href="{{ route('blog.show', $article->slug) }}" itemprop="url">{{ $article->title }}</a>
                                        </h3>
                                        <p itemprop="description">{{ $article->excerpt }}</p>
                                        <div class="mt-auto">
                                            <a href="{{ route('blog.show', $article->slug) }}" class="default-btn" itemprop="url">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        @include('site.blog.partials.paginate')
                    </div>
                </div>
                @include('site.blog.partials.sidebar')
            </div>
        </div>
    </section>


@endsection

@section('jsonld')
    @include('site.blog.partials.jsonld')
@endsection

@section('footjs') @endsection
