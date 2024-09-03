@extends('site.layouts.app')

@section('headcss') @endsection
@section('headjs') @endsection


@section('content')

    @can('faq_category_create')
        <a class="btn btn-success" href="{{ route('frontend.faq-categories.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.faqCategory.title_singular') }}
        </a>
    @endcan
     
     
    @foreach($faqCategories as $key => $faqCategory)
        {{ $faqCategory->id ?? '' }}
        {{ $faqCategory->category ?? '' }}
    @endforeach


@endsection


@section('footjs') @endsection