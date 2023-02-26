<li class="product-list-item">
    <a class="product-list-item-link" href="{{ $product->uri() }}">
        <img class="product-list-item-image" src="{!! $product->present()->image(540, 400) !!}" alt="">
        <div class="product-list-item-info">
            <div class="product-list-item-title">{{ $product->title }}</div>
            @empty(!$product->summary)
            <div class="product-list-item-summary">{{ $product->summary }}</div>
            @endempty
            <div class="product-list-item-date">{{ $product->present()->dateLocalized }}</div>
        </div>
    </a>
</li>
