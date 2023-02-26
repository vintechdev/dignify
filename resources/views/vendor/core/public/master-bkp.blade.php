<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>

    @include('core::public._google_analytics_code')

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-touch-icon-114x114.png') }}">

    <meta property="og:site_name" content="{{ $websiteTitle }}">
    <meta property="og:title" content="@yield('ogTitle')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ URL::full() }}">
    <meta property="og:image" content="@yield('image')">

    {{-- <meta name="twitter:site" content=""> --}}
    <meta name="twitter:card" content="summary_large_image">

    @include('core::public._feed-links')

    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" media="screen">
    @stack('css')

</head>
<body>
    @include('core::public._google_tag_manager_code')
    @include('core::public._loader')

    @section('site-header')
        <header id="top" class="{{  $page && $page->is_home ? 'header-home' : 'header-inner' }}">
           {{-- <p class="site-baseline">{{ TypiCMS::baseline() }}</p>
            @include('core::public._lang-translator')--}}
            <div class="header-nav-content">
                @include('core::public._brand-panel')

                @include('core::public._nav')

                @include('core::public._nav-mobile')
            </div>
        </header>
    @show

  {{--  @section('lang-switcher')
        @include('core::public._lang-switcher')
    @show--}}

    @yield('content')
 {{--   <script data-cfasync="false"
            src="email-decode.min.js"></script>
 --}}
    <script src={{ asset("js/jquery.min.js") }}></script>
    <script src={{ asset("js/bootstrap.min.js") }}></script>
    <script src={{ asset("js/smoothscroll.js") }}></script>
    <script src={{ asset("js/jquery.validate.min.js") }}></script>
    <script src={{ asset("js/wow.min.js") }}></script>
    <script src={{ asset("js/jquery.stellar.min.js") }}></script>
    <script src={{ asset("js/jquery.magnific-popup.js") }}></script>
    <script src={{ asset("js/owl.carousel.min.js") }}></script>
    {{--<script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'dignify_language_translator');
        }
    </script>--}}
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @stack('home-js')

    <script src={{ asset("js/interface.js") }}></script>

    @stack('js')
    <script async="" src="https://embed.tawk.to/5a0141b1198bd56b8c039a60/default" charset="UTF-8" crossorigin="*"></script>
</body>

</html>
