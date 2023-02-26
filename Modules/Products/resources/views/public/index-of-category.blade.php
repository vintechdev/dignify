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

                <?php
				    $attribs = [
					   '250X375' => [
						   'classes' =>'col col-250x375',
						   'dimensions'=> [
							   'height' => '250',
							   'width' => '375'
						   ],
					   ],
					   '300X600' => [
						   //'classes' =>'col col-300x600',
						   'classes' =>'col col-horizontal-rect',
						   'dimensions'=> [
							   'height' => '200',
							   'width' => '400'
						   ],
					   ],
					   '300X450' => [
						   'classes' =>'col col-300x450',
						   'dimensions'=> [
							   'height' => '300',
							   'width' => '450'
						   ],
					   ],
					   '300X300' => [
						   'classes' =>'col col-square',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '400'
						   ],
					   ],
					   '400X400' => [
						   'classes' =>'col col-square',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '400'
						   ],
					   ],
					   '600X600' => [
						   'classes' =>'col col-square',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '400'
						   ],
					   ],
					   '1200X600' => [
						   'classes' =>'col col-1200x600',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '200'
						   ],
					   ],
					   '1600X800' => [
						   'classes' =>'col col-1200x600',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '200'
						   ],
					   ],
					   '2400X800' => [
						   'classes' =>'col col-2400x800',
						   'dimensions'=> [
							   'height' => '600',
							   'width' => 'auto'
						   ],
					   ],
					   '1200X1200' => [
						   'classes' =>'col col-square',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '400'
						   ],
					   ],
					    '2400X1200' => [
						   'classes' =>'col col-1200x600',
						   'dimensions'=> [
							   'height' => '400',
							   'width' => '200'
						   ],
					   ],
                    ];

                    function getTagProperties($t) {
					    $string = strtoupper(trim($t));
						
                        if (isset($attribs[$string]) && !empty($attribs[$string]) ) {
                            return $attribs[$string];
                        }
                
						return null;
                    }

                   function getTagClasses($tagNameProperty = null) {
                       if ($tagNameProperty && isset($tagNameProperty['classes'])
                           && !empty($tagNameProperty['classes'])) {
                           return $tagNameProperty['classes'];
                       }

                       return 'col-sm-6 col-md-4 col-lg-3';
                   }

                   function getTagDimensions($tagNameProperty = null) {
                         if ($tagNameProperty && isset($tagNameProperty['dimensions'])
                             && !empty($tagNameProperty['dimensions'])) {
                                return $tagNameProperty['dimensions'];
                         }

                         return [
                            'height'=> '680',
                            'width' => '480'
                         ];
                    }

                    function getNameFromFileName($productTitle ,$file) {
                        if ($file) {
                           return str_replace("-", " ",str_replace("." .$file->extension, "", $file->name));
                        }

                        return $productTitle;
                    }

					$first = $category->title;
					$second = 'Tiles';
					
					if (trim($category->title) && strpos(trim($category->title), ' ') !== false) {
						list($first, $second) = explode(" ",trim($category->title));
					}
			    ?>

                <div class="js-projects-gallery">
				    @foreach($productsGroupByTags as $tagName => $allProducts)
                        <?php
						    $tString = trim(str_replace("MM", "", strtoupper($tagName)));
							$tp =  isset($attribs[$tString]) ? $attribs[$tString] : null;
							$dimensions = getTagDimensions($tp);
							$tagClasses = getTagClasses($tp);
							list($h, $w) = explode("X", $tString);
							
							$height = isset($dimensions['height']) ? $dimensions['height'] : $h; 
							$width = isset($dimensions['width']) ? $dimensions['width'] : $w; 
							$products = $allProducts->count() > 8 ? $allProducts->random(8):  $allProducts;
					    ?>
                    <header class="section-header mt-50 mb-3">
                        <h2 class="section-title">{{ $first }} <span class="text-primary">{{ $second }} - {{ $tagName }}</span></h2>
                    </header>
                     <div class="row mb-3">
                        @foreach($products as $productKey => $product)
                            @if($product->images->count() > 0)
								<?php $productImages = $product->images->count() > 8 ? $product->images->random(8):  $product->images ;?>
                                @foreach($productImages as $imageKey => $productImage)
									<?php 
										 $imageName = getNameFromFileName($product->title, $productImage);
                                    ?>
                                    <div class="project category-product {{ $tagClasses  }} {{ $imageKey % 2 == 0 ? 'project-light' : ''  }}">
                                        <a href="{{ $productImage->present()->image() }}" title="{{ $imageName }}">
                                            <figure>
                                                <img class="img-responsive" alt=""  src="{{ $productImage->present()->image($height, $width) }}">
                                                <figcaption>
                                                    <h3 class="project-title text-center">{{ $imageName }}</h3>
                                                    <h4 class="project-category">{{ $tagName }}</h4>
                                                    <div class="project-zoom project-lightbox"></div>
                                                </figcaption>
                                            </figure>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="project category-product {{ $tagClasses }} {{ $productKey % 2 == 0 ? 'project-light' : ''  }}">
                                    <a href="{{ $product->present()->image() }}" title="{{ $product->title }}">
                                        <figure>
                                            <img class="img-responsive" alt="" src="{{ $product->present()->image() }}">
                                            <figcaption>
                                                <h3 class="project-title text-center">{{ $product->title }}</h3>
                                                <h4 class="project-category">{{ $tagName }}</h4>
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
                    @endforeach
                </div>
            </section>

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show
        </div>
    </div>
@endsection

