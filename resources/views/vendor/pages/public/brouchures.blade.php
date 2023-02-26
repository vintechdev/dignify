@extends('pages::public.master')

@section('page')
    <div class="layout">
        <main class="main main-inner"
              @if ($page->present()->image()) style="background-image: url({!! $page->present()->image() !!})"
              @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $page->title }}</h1>
                </header>
            </div>
        </main>
        <div class="content">
            <section class="project-details">
                <div class="container">
                    @if($productCategoryTypes = \TypiCMS\Modules\Products\Models\ProductCategoryType::published()->get() and $productCategoryTypes->count() > 0)

                        @php
                            $tagsByCategoryTypes = \TypiCMS\Modules\Products\Facades\Brochures::getAllGroupByTypeAndSize();
                        @endphp

                        <div class="section-content">
                            <div class="row-base row">
                                <div class="col-md-12">
                                    @foreach($productCategoryTypes as $key => $productCategoryType)
                                        <div class="project-details-item">
                                            <div class="row">
                                                <div
                                                    class="project-details-info wow {{  ($key%2) == 0 ? 'fadeInLeft' : 'fadeInRight'   }}">
                                                    <h3 class="project-details-title">
                                                        {{ $productCategoryType->title }}
                                                    </h3>
                                                    <div class="project-details-descr">
                                                        @if ($tagsByCategoryTypes->has($productCategoryType->id) && $tagsData = $tagsByCategoryTypes->get($productCategoryType->id))
                                                            @php
                                                                $tags = $tagsData->pluck('tag', 'slug')
                                                            @endphp

                                                            @foreach($tags as $tagSlug => $tag)
                                                                <div class="size-cate">
                                                                    <a href="/brochures/{{ $productCategoryType->slug }}/{{ $tagSlug }}"> {{ $tag }} <span><i
                                                                                class="fa fa-angle-right"></i></span></a>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="project-details-img col-md-8
                                            {{  ($key%2) == 0 ? 'col-md-offset-4': ''}}
                                                    ">
                                                    <img alt="" class="img-responsive"
                                                         src="{{ $productCategoryType->present()->image(760,651, ['resize'])  }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show

        </div>
    </div>
@endsection
