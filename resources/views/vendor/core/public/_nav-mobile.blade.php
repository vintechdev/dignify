@php
    $uriPath = '';
    if (request()->segment(1) === app()->getLocale()):
        $uriPath = strtolower(request()->segment(1). '/' . request()->segment(2));
    elseif (request()->segment(1) !== app()->getLocale()):
        $uriPath = strtolower(app()->getLocale(). '/' . request()->segment(1));
    endif;

    $uriPath = trim($uriPath, "/");
@endphp
@if ($menu = Menus::getMenu('main'))
<nav class="navbar-mobile">
    <a href="#top" class="brand js-target-scroll">
        @if (TypiCMS::hasLogo())
            <img class="brand-logo-scroll" src="{{ Storage::url('settings/'.config('typicms.image')) }}"
                 alt="{{ TypiCMS::title() }}">
        @else
            {{ TypiCMS::title() }}
        @endif
    </a>

    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-mobile">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav-mobile">
            @foreach ($menu->menulinks as $menulink)
                @php
                    $childMatch = false;

                    if($menulink && $menulink->items->count() > 0):
                        $childMatch = in_array($uriPath, $menulink->items->pluck('href')->all());
                    endif;
                @endphp

                <li class="{{ ($uriPath && $uriPath == $menulink->href  || $childMatch) ? 'active' : '' }}">
                    @if ($menulink->class === 'products'  || in_array(strtolower($menulink->title), ['tiles', 'products']) || $menulink->items->count() > 0)
                        <a href="#">
                    @else
                        <a href="{{ url($menulink->href) }}">
                    @endif
                        {{ $menulink->title }}
                        @if ($menulink->class === 'products' || in_array(strtolower($menulink->title), ['tiles', 'products']) || $menulink->items->count() > 0)
                            <i class="fa fa-angle-down"></i>
                        @endif
                    </a>

                    @if($menulink->class === 'products'  || in_array(strtolower($menulink->title), ['tiles', 'products']))

                        @if($productCategoryTypes = \TypiCMS\Modules\Products\Models\ProductCategoryType::published()->get() and $productCategoryTypes->count() > 0)
                            <ul>
                                @foreach ($productCategoryTypes as $productCategoryType)
                                    <li class=""><a href="/{{ app()->getLocale() . '/tiles/'. $productCategoryType->slug }}">{{ $productCategoryType->title }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @elseif ($menulink->items->count() > 0)
                        <ul>
                            @foreach ($menulink->items as $menulink)
                                <li class=""><a href="{{ url($menulink->href) }}">{{ $menulink->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</nav>
@endif
