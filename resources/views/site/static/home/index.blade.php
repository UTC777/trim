@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')
	@include('site.static.home.parts.slider')
	@include('site.static.home.parts.expertise-area')
	@include('site.static.home.parts.about')
	@include('site.static.home.parts.why-choose-us-area')
	@include('site.static.home.parts.what-we-offer-area')
	@include('site.static.home.parts.appointment-area')
	@include('site.static.home.parts.customer-story-area')
	@include('site.static.home.parts.team-area')
	@include('site.static.home.parts.testimonials-area')
	@include('site.static.home.parts.healthy-life-area')
	@include('site.static.home.parts.our-news-area')
@endsection


@section('footjs') @endsection