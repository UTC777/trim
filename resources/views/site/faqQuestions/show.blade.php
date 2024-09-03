@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')

{{ $faqQuestion->id }}
{{ $faqQuestion->category->category ?? '' }}
{{ $faqQuestion->question }}
{{ $faqQuestion->answer }}

<a class="btn btn-default" href="{{ route('frontend.faq-questions.index') }}">
    {{ trans('global.back_to_list') }}
</a>

@endsection


@section('footjs') @endsection