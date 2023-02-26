@extends('core::public.master')

@section('title', $model->title.' – '.__('Catalogs').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->image(1200, 630))
@section('bodyClass', 'body-catalogs body-catalog-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    @include('core::public._btn-prev-next', ['module' => 'Catalogs', 'model' => $model])

    @include('catalogs::public._json-ld', ['catalog' => $model])

    <article class="catalog">
        <h1 class="catalog-title">{{ $model->title }}</h1>
        @empty(!$model->image)
        <picture class="catalog-picture">
            <img class="catalog-picture-image" src="{!! $model->present()->image(2000, 1000) !!}" alt="">
            @empty(!$model->image->description)
            <legend class="catalog-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->summary)
        <p class="catalog-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->body)
        <div class="catalog-body">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </article>

@endsection
