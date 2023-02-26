@extends('pages::public.master')

@section('bodyClass', 'body-slides body-slides-index body-page body-page-'.$page->id)

@section('content')

    <div class="rich-content">{!! $page->present()->body !!}</div>

    @include('files::public._documents', ['model' => $page])
    @include('files::public._images', ['model' => $page])

    @includeWhen($models->count() > 0, 'slides::public._list', ['items' => $models])

@endsection
