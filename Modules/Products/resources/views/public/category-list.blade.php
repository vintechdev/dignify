<section class="blog-list section">
    <div class="container">
        @foreach ($categories as $category)

            @php
                $tags = [];
                foreach ($category->products as $product) {
                    if ($product->tags()->count() > 0) {
                        $tags = array_merge($tags, $product->tags()->pluck('tag')->toArray());
                    }
                }
                $tags = (array_unique($tags));
				arsort($tags, 4);
				
            @endphp

            <article class="blog">
                <div class="row">
                    <div class="blog-thumbnail col-md-8">
                        <div class="blog-thumbnail-bg col-md-8 visible-md visible-lg"
                             style="background-image: url({{ $category->present()->image() }});"></div>
                        <div class="blog-thumbnail-img visible-xs visible-sm">
                            <img alt="" class="img-responsive" src="{{ $category->present()->image() }}"></div>
                    </div>
                    <div class="blog-info col-md-4">
                        <h3 class="blog-title">
                            <a href="/{{ app()->getLocale() . '/tiles/'. $categoryType->slug . '/'. $category->slug }}">{{ Str::upper($category->present()->title)  }}</a>
                        </h3>
                        <div class="sizes">
                            <div class="sizes-title">
                                <h4>
                                    Available Sizes
                                </h4>
                            </div>

                            <div class="sizes-body">
                                @foreach($tags as $tag)
                                <p>{{ $tag }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog-meta">
                        </div>
                        <div class="text-right"><a href="/{{ app()->getLocale() . '/tiles/'. $categoryType->slug . '/'. $category->slug }}" class="read-more">View more</a></div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
