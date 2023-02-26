<li class="slide-list-item">
    <a class="slide-list-item-link" href="{{ $slide->uri() }}">
        <img class="slide-list-item-image" src="{!! $slide->present()->image(540, 400) !!}" alt="">
        <div class="slide-list-item-info">
            <div class="slide-list-item-title">{{ $slide->title }}</div>
            @empty(!$slide->summary)
            <div class="slide-list-item-summary">{{ $slide->summary }}</div>
            @endempty
            <div class="slide-list-item-date">{{ $slide->present()->dateLocalized }}</div>
        </div>
    </a>
</li>
