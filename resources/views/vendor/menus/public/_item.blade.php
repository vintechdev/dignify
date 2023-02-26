@php
   $childMatch = false;

   if($menulink && $menulink->items->count() > 0):
       $childMatch = in_array($uriPath, $menulink->items->pluck('href')->all());
   endif;

@endphp

<li class="nav-it {{ ($uriPath && ($uriPath == $menulink->href || $childMatch)) ? 'active' : '' }}">
    <a class="menu-link {{ $menulink->items->count() > 0 ? 'dropdown-toggle' : '' }}"
       href="{{ url($menulink->href) }}"
       @if ($menulink->target === '_blank')
            target="_blank" rel="noopener noreferrer"
       @endif
       @if ($menulink->items->count() > 0)
            data-toggle="dropdown"
        @endif
    >{{ $menulink->title }}</a>

    @if(in_array(strtolower($menulink->title), ['tiles', 'products']))
        @if($productCategoryTypes = \TypiCMS\Modules\Products\Models\ProductCategoryType::get() and $productCategoryTypes->count() > 0)
            <ul>
                @foreach ($productCategoryTypes as $productCategoryType)
                    <li class="nav-sub-it"><a href="/{{ app()->getLocale() . '/tiles/'. $productCategoryType->slug }}">{{ $productCategoryType->title }}</a></li>
                @endforeach
            </ul>
        @endif

    @elseif ($menulink->items->count() > 0)
        <ul>
            @foreach ($menulink->items as $menulink)
                <li class="nav-sub-it"><a href="{{ url($menulink->href) }}">{{ $menulink->title }}</a></li>
            @endforeach
        </ul>
    @endif
</li>
