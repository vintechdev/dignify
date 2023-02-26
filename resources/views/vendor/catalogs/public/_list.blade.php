<ul class="catalog-list-list">
    @foreach ($items as $catalog)
    @include('catalogs::public._list-item')
    @endforeach
</ul>
