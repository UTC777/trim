@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')
@include('site.faqQuestions.partials.top-section')

    <!-- Start FAQ Area -->
    <section class="faq-area faq-page-style ptb-100" itemscope itemtype="http://schema.org/FAQPage">
        <div class="container">
            <div class="section-title">
                <span>FAQs</span>
                <h2>Frequently Asked Questions</h2>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-12 mb-3">
                    <div class="faq-accordion mb-need">
                        <ul class="accordion">
                            @foreach($faqQuestions as $faq)
                                <li class="accordion-item" itemscope itemprop="mainEntity" itemtype="http://schema.org/Question">
                                    <a class="accordion-title" href="javascript:void(0)">
                                        <i class="bx bx-chevron-down"></i>
                                        <span itemprop="name">{!! $faq->question !!}</span>
                                    </a>
                                    <div class="accordion-content" itemscope itemprop="acceptedAnswer" itemtype="http://schema.org/Answer">
                                        <div itemprop="text">
                                            @if ($faq->use_html_answer==1)
                                                {!! $faq->html_answer !!}
                                            @else
                                                {!! $faq->answer !!}
                                            @endif
                                        </div>

                                        @if ($faq->youtube_video_id_only && $faq->video_button_text)
                                            <div class="pt-2 pb-2">
                                                <button class="default-btn js-video-button" data-video-id='{{ $faq->youtube_video_id_only }}'>{{ $faq->video_button_text }}</button>
                                            </div>
                                        @endif

                                        @if ($faq->read_more_button_text && $faq->read_more_link)
                                            <div class="pt-2 pb-2">
                                                <a target="_blank" href="{{ $faq->read_more_link }}" class="read-more">{{ $faq->read_more_button_text }}</a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End FAQ Area -->


@include('site.faqQuestions.partials.contact-form')


@endsection

@section('jsonld')
    @include('site.faqQuestions.partials.jsonld')
@endsection

@section('footjs')
<script>
	$(".js-video-button").modalVideo();
</script>
@endsection
