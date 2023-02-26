@extends('pages::public.master')

@section('page')
    <div class="layout">
        <main class="main main-inner" @if ($page->present()->image()) style="background-image: url({!! $page->present()->image() !!})" @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $page->title }}</h1>
                </header>
            </div>
        </main>
        <div class="content">
            {!! $page->present()->body !!}

            @if($sections = $page->publishedSections()->get() and $sections->count() > 0)
                @foreach($sections as $section)
                    {!! $section->present()->body !!}
                @endforeach
            @endif

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show
        </div>
    </div>
@endsection
