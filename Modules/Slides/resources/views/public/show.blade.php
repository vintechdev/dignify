@extends('core::public.master')

@section('title', $model->title.' – '.__('Slides').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->image(1200, 630))
@section('bodyClass', 'body-slides body-slide-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    <div class="btn-group-prev-next">
        <div class="btn-group">
            <a class="btn btn-sm btn-outline-secondary btn-prev @if (!$prev = Slides::prev($model, $model->category_id))disabled @endif" href="@if ($prev){{ route($lang.'::slide', [$prev->category->slug, $prev->slug]) }}@endif">{{ __('Previous') }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-list" href="{{ route($lang.'::slides-category', $model->category->slug) }}">{{ $model->category->title }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-next @if (!$next = Slides::next($model, $model->category_id))disabled @endif" href="@if ($next){{ route($lang.'::slide', [$next->category->slug, $next->slug]) }}@endif">{{ __('Next') }}</a>
        </div>
    </div>

    <article class="slide">
        <h1 class="slide-title">{{ $model->title }}</h1>
        @empty(!$model->image)
        <picture class="slide-picture">
            <img class="slide-picture-image" src="{!! $model->present()->image(2000, 1000) !!}" alt="">
            @empty(!$model->image->description)
            <legend class="slide-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->summary)
        <p class="slide-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->body)
        <div class="slide-body">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </article>

@endsection
