<li class="catalog-list-item">
    <a class="catalog-list-item-link" href="{{ $catalog->uri() }}" title="{{ $catalog->title }}">
        <span class="catalog-list-item-title">{!! $catalog->title !!}</span>
        <span class="catalog-list-item-image-wrapper">
            <img class="catalog-list-item-image" src="{!! $catalog->present()->image(null, 200) !!}" alt="">
        </span>
    </a>
</li>
