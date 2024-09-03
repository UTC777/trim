@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection

@section('content')

    <div class="page-title-area bg-13">
        <div class="container">
            <div class="page-title-content">
                <h2 itemprop="headline">{{ $article->title }}</h2>
                @include('site.blog.partials.show.breadcrumbs')
            </div>
        </div>
    </div>
    {{-- <section class="news-details ptb-100"> --}}
    <article itemscope itemtype="http://schema.org/BlogPosting" class="news-details ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="news-details-content">
                        <div class="news-details-img" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            @if($article->featured_image)
                                <img src="{{ $article->featured_image->getUrl('featured') }}" alt="Image" itemprop="url">
                                <meta itemprop="width" content="800">
                                <meta itemprop="height" content="600">
                            @endif
                        </div>
                        <div class="news-top-content">
                            <div class="news-content" itemprop="articleBody">
                                <ul class="admin">
                                    <li>
                                        <a href="javascript:void(0);" itemprop="author" itemscope itemtype="http://schema.org/Person">
                                            <i class="bx bxs-user"></i>
                                            <span itemprop="name">{{ $article->author ? $article->author->name : '' }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" itemprop="articleSection">
                                            <span>{{ $article->categories->pluck('name')->first() }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <i class="bx bx-calendar"></i>
                                        <time itemprop="datePublished" datetime="{{ $article->created_at->toIso8601String() }}">
                                            {{ optional($article->updated_at ?? $article->created_at)->format('m/d/Y') }}
                                        </time>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="bx bx-comment"></i>
                                            No Comments
                                        </a>
                                    </li>
                                </ul>
                                {!! $article->page_text !!}
                            </div>
                        </div>
                        @include('site.blog.partials.show.tags')
                        @include('site.blog.partials.show.comment-section')
                        @include('site.blog.partials.show.comment-form')
                    </div>
                </div>
                @include('site.blog.partials.show.sidebar')
            </div>
        </div>
    </article>

@endsection

@section('jsonld')
    @include('site.blog.partials.show.jsonld')
@endsection

@section('footjs') @endsection
