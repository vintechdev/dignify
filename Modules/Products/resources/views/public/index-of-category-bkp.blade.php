@extends('pages::public.master')
@section('title', $category->title)
@section('page')
    <div class="layout">
        <main class="main main-inner"
              @if ($category->bannerImage) style="background-image: url({!! $category->bannerImage->getUrlAttribute() !!})"
              @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $category->title }}</h1>
                </header>
            </div>
        </main>

        <div class="content">
            <section class="projects">
                @php
                    function getNameFromFileName($productTitle ,$file) {
                        if ($file) {
                             return $productTitle . " " .str_replace("-", " ",str_replace("." .$file->extension, "", $file->name));
                        }

                        return $productTitle;
                    }

					$first = $category->title;
					$second = 'Tiles';
					if (trim($category->title) && strpos(trim($category->title), ' ') !== false) {
						list($first, $second) = explode(" ",trim($category->title));
					}
                @endphp
                <header class="section-header mt-100 mb-100">
                    <h2 class="section-title">{{ $first }} <span class="text-primary">{{ $second }}</span></h2>
                    <strong class="fade-title-right">{{ $first }}</strong>
                </header>
                <div class="js-projects-gallery">
                    <div class="row">
                        @foreach($products as $productKey => $product)
                            @if($product->images->count() > 0)
                                @foreach($product->images as $imageKey => $productImage)
                                <div class="project col-sm-6 col-md-4 col-lg-3 {{ $imageKey % 2 == 0 ? 'project-light' : ''  }}">
                                    <a href="{{ $productImage->present()->image() }}" title="{{ $product->title }}">
                                        <figure>
                                            <img class="img-responsive" alt="" src="{{ $productImage->present()->image(480, 680) }}">
                                            <figcaption>
                                                <h3 class="project-title">
                                                    {{ getNameFromFileName($product->title, $productImage) }}
                                                </h3>

                                                @foreach ($product['tags'] as $tagKey => $tag)
                                                    <h4 class="project-category @if($tagKey > 0) project-size-{{ $tagKey+1 }} @endif">
                                                        {{ $tag->tag }}
                                                    </h4>
                                                @endforeach
                                                <div class="project-zoom project-lightbox"></div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                                @endforeach
                            @else
                            <div class="project col-sm-6 col-md-4 col-lg-3 {{ $productKey % 2 == 0 ? 'project-light' : ''  }}">
                                <a href="{{ $product->present()->image() }}" title="{{ $product->title }}">
                                    <figure>
                                        <img class="img-responsive" alt="" src="{{ $product->present()->image(480, 680) }}">
                                        <figcaption>
                                            <h3 class="project-title">
                                                {{ $product->title }}
                                            </h3>

                                            @foreach ($product['tags'] as $tagKey => $tag)
                                                <h4 class="project-category @if($tagKey > 0) project-size-{{ $tagKey+1 }} @endif">
                                                    {{ $tag->tag }}
                                                </h4>
                                            @endforeach
                                            <div class="project-zoom project-lightbox"></div>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                            @endif
                        @endforeach

						@if($products->count() < 2)
						<div class="col-sm-6 col-md-8 col-lg-9" >
							<a style="">
							  <figure>
							       <figcaption>
                                        <h3 class="text-center">More Coming Soon...</h3>
									</figcaption>
							  </figure>
							</a>
						</div>
						@endif

                    </div>
                </div>
            </section>

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show
        </div>
    </div>
@endsection

