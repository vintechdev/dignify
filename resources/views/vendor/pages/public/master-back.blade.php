@extends('core::public.master')

@section('title', $page->title.' – '.$websiteTitle)
@section('ogTitle', $page->title)
@section('description', $page->meta_description)
@section('keywords', $page->meta_keywords)
@if ($page->image)
    @section('image', $page->present()->image(1200, 630))
@endif
@section('bodyClass', 'body-page body-page-'.$page->id)

@push('css')
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"  media="screen">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"  media="screen">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet"  media="screen">
@endpush
@if ($page->css)
    @push('css')
        <style type="text/css">{{ $page->css }}</style>
    @endpush
@endif

@section('content')

    @yield('page')

@endsection
@if ($page->js)
    @push('js')
        <script>{!! $page->js !!}</script>
    @endpush
@endif
