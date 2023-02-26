@extends('core::public.master')

@section('title', $model->title.' – '.__('Products').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->image(1200, 630))
@section('bodyClass', 'body-products body-product-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    <div class="btn-group-prev-next">
        <div class="btn-group">
            <a class="btn btn-sm btn-outline-secondary btn-prev @if (!$prev = Products::prev($model, $model->category_id))disabled @endif" href="@if ($prev){{ route($lang.'::product', [$prev->category->slug, $prev->slug]) }}@endif">{{ __('Previous') }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-list" href="{{ route($lang.'::products-category', $model->category->slug) }}">{{ $model->category->title }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-next @if (!$next = Products::next($model, $model->category_id))disabled @endif" href="@if ($next){{ route($lang.'::product', [$next->category->slug, $next->slug]) }}@endif">{{ __('Next') }}</a>
        </div>
    </div>

    <article class="product">
        <h1 class="product-title">{{ $model->title }}</h1>
        @empty(!$model->image)
        <picture class="product-picture">
            <img class="product-picture-image" src="{!! $model->present()->image(2000, 1000) !!}" alt="">
            @empty(!$model->image->description)
            <legend class="product-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->summary)
        <p class="product-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->body)
        <div class="product-body">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </article>

@endsection
