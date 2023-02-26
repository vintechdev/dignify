@extends('pages::public.master')

@section('bodyClass', 'body-category-types body-products-index body-page body-page-'.$page->id)

{{--@section('content')

    <div class="content">
        {!! $page->present()->body !!}
    </div>

    @include('files::public._documents', ['model' => $page])
    @include('files::public._images', ['model' => $page])

    @includeWhen($models->count() > 0, 'products::public._list', ['items' => $models])

@endsection--}}

@section('page')
    <div class="layout">
        <main class="main main-inner"
              @if ($categoryType->present()->image()) style="background-image: url({!! $categoryType->present()->image() !!})"
              @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $categoryType->title }}</h1>
                </header>
            </div>
        </main>
        <div class="content">
            @includeWhen($models->count() > 0, 'products::public.category-list', [
            'categories' => $models,
            'categoryType' => $categoryType
            ])

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show
        </div>
    </div>
@endsection
