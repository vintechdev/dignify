<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $page->title.' – '.$websiteTitle }}</title>
<meta name="description" content="{{ $page->meta_description  }}">
<meta name="keywords" content="{{ $page->meta_keywords }}">

<meta property="og:site_name" content="{{ $websiteTitle }}">
<meta property="og:title" content="{{ $page->title }}">
<meta property="og:description" content="{{ $page->meta_description }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ URL::full() }}">
@if ($page->image)
    <meta property="og:image" content="{{ $page->present()->image(1200, 630) }}">
@endif
<meta name="twitter:card" content="summary_large_image">
