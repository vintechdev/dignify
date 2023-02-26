<li class="cat-list-item">
    <a class="cat-list-item-link" href="{{ $cat->uri() }}" title="{{ $cat->title }}">
        <span class="cat-list-item-title">{!! $cat->title !!}</span>
        <span class="cat-list-item-image-wrapper">
            <img class="cat-list-item-image" src="{!! $cat->present()->image(null, 200) !!}" alt="">
        </span>
    </a>
</li>
