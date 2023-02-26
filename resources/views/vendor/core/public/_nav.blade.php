@php
    $uriPath = '';
    if (request()->segment(1) === app()->getLocale()):
        $uriPath = strtolower(request()->segment(1). '/' . request()->segment(2));
    elseif (request()->segment(1) !== app()->getLocale()):
        $uriPath = strtolower(app()->getLocale(). '/' . request()->segment(1));
    endif;

@endphp
@if ($menu = Menus::getMenu('main'))
<nav class="navbar-desctop visible-md float-right visible-lg">
    <div class="container">
        @php
          list($titleFirst, $titleSecond) = explode(" ", trim(TypiCMS::title()))
        @endphp
        <a href="#top" class="brand js-target-scroll">
            {{ $titleFirst }} <span class="text-primary">{{ $titleSecond }}</span>
        </a>
        @if ($menu->menulinks->count() > 0)
            <ul class="navbar-desctop-menu">
                @foreach ($menu->menulinks as $menulink)
                    @include('menus::public._item',  ['uriPath' => $uriPath])
                @endforeach
            </ul>
        @endif
    </div>
</nav>
@endif
