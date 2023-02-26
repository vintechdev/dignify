<div class="brand-panel">
    <a class="brand js-target-scroll" href="{{ TypiCMS::homeUrl() }}">
        @if (TypiCMS::hasLogo())
            <img class="brand-logo img-responsive" src="{{ Storage::url('settings/'.config('typicms.image')) }}" alt="{{ TypiCMS::title() }}" >
        @else
            {{ TypiCMS::title() }}
        @endif
    </a>
    <div class="brand-name">{{ $websiteTitle }}</div>
    @yield('slider-details')
</div>
<div class="header-phone">
    <div>Export :- +91 9825868500</div>
    <div>Domestic :- +91 9725803333</div>
</div>
@if($page && $page->is_home)
    <div class="vertical-panel"></div>
@endif
<div class="vertical-panel-content">
	<div class="vertical-panel-info">
		<div class="vertical-panel-title">{{ TypiCMS::title() }}</div>
		<div class="line"></div>
	</div>
	<ul class="social-list">
		<li><a href="https://www.instagram.com/dignifykeramos333" class="fa fa-instagram"></a></li>
		<li><a href="https://www.linkedin.com/in/dignify-keramos-aaa5bab0" class="fa fa-linkedin"></a></li>
		<li><a href="https://in.pinterest.com/expokdignify" class="fa fa-pinterest"></a></li>
		<li><a href="https://www.tumblr.com/blog/dignifykeramos333" class="fa fa-tumblr"></a></li>
		<li><a href="https://twitter.com/DignifyKeramos" class="fa fa-twitter"></a></li>
		{{-- <li><a href="#" class="fa fa-facebook"></a></li>--}}
	</ul>
</div>





