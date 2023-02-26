@php
    $uriPath = '';
    if (request()->segment(1) === app()->getLocale()):
        $uriPath = strtolower(request()->segment(1). '/' . request()->segment(2));
    elseif (request()->segment(1) !== app()->getLocale()):
        $uriPath = strtolower(app()->getLocale(). '/' . request()->segment(1));
    endif;
@endphp


@if ($menu = Menus::getMenu($name))

    @if ($menu->menulinks->count() > 0)
    <ul class="menu-{{ $name }}-list {{ $menu->class }}" role="menu">
        @foreach ($menu->menulinks as $menulink)
            @include('menus::public._item', ['uriPath' => $uriPath])
        @endforeach
    </ul>
    @endif

@endif
