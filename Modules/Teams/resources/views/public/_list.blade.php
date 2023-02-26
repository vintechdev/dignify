<ul class="team-list-list">
    @foreach ($items as $team)
    @include('teams::public._list-item')
    @endforeach
</ul>
