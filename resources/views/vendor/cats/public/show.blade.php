@extends('core::public.master')

@section('title', $model->title.' – '.__('Cats').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->image(1200, 630))
@section('bodyClass', 'body-cats body-cat-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    @include('core::public._btn-prev-next', ['module' => 'Cats', 'model' => $model])

    @include('cats::public._json-ld', ['cat' => $model])

    <article class="cat">
        <h1 class="cat-title">{{ $model->title }}</h1>
        @empty(!$model->image)
        <picture class="cat-picture">
            <img class="cat-picture-image" src="{!! $model->present()->image(2000, 1000) !!}" alt="">
            @empty(!$model->image->description)
            <legend class="cat-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->summary)
        <p class="cat-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->body)
        <div class="cat-body">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </article>

@endsection
