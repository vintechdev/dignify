@extends('pages::public.master')

@section('bodyClass', 'body-products body-products-categories body-page body-page-'.$page->id)

@section('content')

    <div class="rich-content">{!! $page->present()->body !!}</div>

    @include('files::public._documents', ['model' => $page])
    @include('files::public._images', ['model' => $page])

    @if ($categories->count() > 0)

        <ul class="category-list-list">
            @foreach ($categories as $category)
            <li class="category-list-item">
                <a class="category-list-item-link" href="{{ route($lang.'::products-category', [$category->slug]) }}">
                    <div class="category-list-item-title">{{ $category->title }}</div>
                    <div class="category-list-item-image-wrapper">
                        <img class="category-list-item-image" src="{!! $category->present()->image(270, 270) !!}" alt="">
                    </div>
                </a>
            </li>
            @endforeach
        </ul>

    @endif

@endsection
