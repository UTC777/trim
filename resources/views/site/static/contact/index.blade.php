@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')

	@include('site.static.contact.partials.title-block')
	@include('site.static.contact.partials.info')
	@include('site.static.contact.partials.form')
	@include('site.static.contact.partials.map')

@endsection

@section('footjs') @endsection