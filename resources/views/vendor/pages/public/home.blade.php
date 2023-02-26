@extends('pages::public.master')

{{--@section('site-title')
<h1 class="site-title">@include('core::public._site-title')</h1>
@endsection--}}

@section('slider-details')
    <div class="slide-number text-white">
        <span class="current-number">0<span class="count">1</span></span>
        <sup><span class="delimiter">/</span> 0<span class="total-count"></span></sup>
    </div>
@endsection

@section('page')
    @if ($page->image)
        <img class="page-image" src="{!! $page->present()->image(200, 200) !!}" alt="">
    @endif
    <div class="layout">
        @include('slides::public._slides')

        <div class="content">
            {!! $page->present()->body !!}

            @if($sections = $page->publishedSections()->get() and $sections->count() > 0)
                @foreach($sections as $section)
                    {!! $section->present()->body !!}
                @endforeach
            @endif

            <section class="projects section">
                <div class="container">
                    <h2 class="section-title">Our <span class="text-primary">Products</span></h2>
                </div>
                <div class="section-content">
                    <!-- <div class="projects-carousel js-projects-carousel js-projects-gallery"> -->
                    @if ($productCategories = ProductCategories::published()->get() and $productCategories->count() > 0)

                    <div class="projects-carousel js-projects-carousel">
                        @foreach($productCategories as $productCategory)
                            <div class="project project-light home-category">
                                <a href="{{ app()->getLocale() . '/tiles/' . $productCategory->productCategoryType->slug . '/' . $productCategory->slug }}" title="{{ $productCategory->title }}">
                                    <figure class="figure">
                                        <img alt="{{ $productCategory->title }}" src="{{  $productCategory->homeImage ? $productCategory->homeImage->getUrlAttribute() : '' }}">
                                        <figcaption class="caption">
                                            <h3 class="project-title">
                                                {{ $productCategory->title }}
                                            </h3>
                                            <h4 class="project-category">
                                                {{ $productCategory->productCategoryType->title }}
                                            </h4>
                                            <div class="project-zoom"></div>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                        @endforeach
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

@push('home-js')
    <script  src={{ asset("js/rev-slider/jquery.themepunch.tools.min.js") }}></script>
    <script  src={{ asset("js/rev-slider/jquery.themepunch.revolution.min.js") }}></script>
    <script  src={{ asset("js/rev-vendor.js") }}></script>
@endpush
