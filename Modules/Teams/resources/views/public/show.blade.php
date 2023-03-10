@extends('core::public.master')

@section('title', $model->title.' – '.__('Teams').' – '.$websiteTitle)
@section('ogTitle', $model->title)
@section('description', $model->summary)
@section('image', $model->present()->image(1200, 630))
@section('bodyClass', 'body-teams body-team-'.$model->id.' body-page body-page-'.$page->id)

@section('content')

    <div class="btn-group-prev-next">
        <div class="btn-group">
            <a class="btn btn-sm btn-outline-secondary btn-prev @if (!$prev = Teams::prev($model, $model->category_id))disabled @endif" href="@if ($prev){{ route($lang.'::team', [$prev->category->slug, $prev->slug]) }}@endif">{{ __('Previous') }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-list" href="{{ route($lang.'::teams-category', $model->category->slug) }}">{{ $model->category->title }}</a>
            <a class="btn btn-sm btn-outline-secondary btn-next @if (!$next = Teams::next($model, $model->category_id))disabled @endif" href="@if ($next){{ route($lang.'::team', [$next->category->slug, $next->slug]) }}@endif">{{ __('Next') }}</a>
        </div>
    </div>

    <article class="team">
        <h1 class="team-title">{{ $model->title }}</h1>
        @empty(!$model->image)
        <picture class="team-picture">
            <img class="team-picture-image" src="{!! $model->present()->image(2000, 1000) !!}" alt="">
            @empty(!$model->image->description)
            <legend class="team-picture-legend">{{ $model->image->description }}</legend>
            @endempty
        </picture>
        @endempty
        @empty(!$model->summary)
        <p class="team-summary">{!! nl2br($model->summary) !!}</p>
        @endempty
        @empty(!$model->body)
        <div class="team-body">{!! $model->present()->body !!}</div>
        @endempty
        @include('files::public._documents')
        @include('files::public._images')
    </article>

@endsection
