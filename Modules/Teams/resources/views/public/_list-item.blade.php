<li class="team-list-item">
    <a class="team-list-item-link" href="{{ $team->uri() }}">
        <img class="team-list-item-image" src="{!! $team->present()->image(540, 400) !!}" alt="">
        <div class="team-list-item-info">
            <div class="team-list-item-title">{{ $team->title }}</div>
            @empty(!$team->summary)
            <div class="team-list-item-summary">{{ $team->summary }}</div>
            @endempty
            <div class="team-list-item-date">{{ $team->present()->dateLocalized }}</div>
        </div>
    </a>
</li>
