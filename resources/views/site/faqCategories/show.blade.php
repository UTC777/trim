@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')

    <a class="btn btn-default" href="{{ route('frontend.faq-categories.index') }}">
        {{ trans('global.back_to_list') }}
    </a>
                {{ $faqCategory->id }}
                {{ $faqCategory->category }}
    <a class="btn btn-default" href="{{ route('frontend.faq-categories.index') }}">
        {{ trans('global.back_to_list') }}
    </a>

@endsection


@section('footjs') @endsection