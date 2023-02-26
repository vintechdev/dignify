<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>{{ $brochure->productCategory->title }} {{ $brochure->tag->tag }}</title>
    <link href="//fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Roboto', sans-serif;
            background-color: #B5B5B5;
            color: white;
        }

        #pdf-wrapper {
            width: 100%;
            background: #165C82;
            height: 100%;
            text-align: center;
            position: relative;
        }
        @page {
            size: A4;
            padding: 0;
            margin: 0;
            background-color: #B5B5B5;
        }
        .section-title {
            margin-bottom: 20px;
            clear: both;
            display: block;
            width: 100%;
        }
        header {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color:  #165C82;
            height: 100px;
            width: 100%;
            color: #FFFFFF;
            text-transform: uppercase;
            font-weight: 400;
            overflow: auto;
            padding-left: 5px;
            padding-right: 5px;
        }
        header > div {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
        }
        header .left {
            width: 20%;
            vertical-align: bottom;
        }
        header .center {
            width: 56%;
        }

        header .right {
            width: 24%;
            text-align: center;
            vertical-align: baseline;
            margin-top: 15px;
        }

        #cover-page {
            margin-top: 105px;
            background-image: url({{ url("/img/cover/cover.png")}});
            height: 600px;
            width: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .content-block {
            display: inline-block;
        }

        .text-center {
            text-align: center;
        }

        .content-50 {
            display: inline-block;
            max-width: 50%;
            width: 49.50%;
            overflow: hidden;
            max-height: 300px;
        }

        .content-60 {
            max-width: 59%;
            width: 59%;
            overflow: hidden;
        }
        .content-40 {
            max-width: 40%;
            width: 40%;
            overflow: hidden;
        }
        .image-container {
            width: 100%;
            clear: both;
            display: block;
            padding-left: 5px;
            padding-right: 5px;
            padding-top: 50px;
        }

        .vertical-align-middle{
            vertical-align: middle;
        }

        .page-breaker {
            page-break-after: always;
        }
        .text-align-justify {
            text-align: justify;
        }
        .page {
            display: block;
            width: 100%;
            height: inherit;
        }

        .image-container {
            margin-top: 50px;
        }
        .cover-footer {
           margin-top: 60px;
        }
    </style>
</head>
<body>
<div id="pdf-wrapper">
    <header>
        <div class="left">
            <img src="{{ url('/img/logo/logo-dignify.png') }}" height="100px">
        </div>
        <div class="center">
            <h3 style="margin-bottom: 5px">Dignify Keramos</h3>
            <h4 style="margin-bottom: 5px; margin-top: 2px;">Since 2015</h4>
        </div>
        <div class="right">
            <img src="{{ url('/img/cover/ISO.png') }}" height="90zxcpx">
        </div>
    </header>

    <div id="cover-page" ></div>
    <div class="cover-footer" >
         <div class="content-block content-60 vertical-align-middle text-align-justify">
             <div style="margin-left: 50px;">
                <h3>Dignify Keramos - {{ $brochure->productCategory->productCategoryType->title }}</h3>
                <h4>{{ $brochure->productCategory->title }}</h4>
                <h4>{{ $brochure->tag->tag }}</h4>
             </div>
         </div>
        <div class="content-block content-40">
            <img src="{{ url('/img/logo/logo-dignify.png') }}" style="height: 120px;" />
        </div>
    </div>
    <h3 class="text-center" style="text-transform: uppercase">
        Tiles for Your Beautiful Home
    </h3>
    <div class="page-breaker"></div>

    @foreach($brochure->brochureDetails as $k => $brochureDetail)
        <div class="page page-{{ $k+1 }}">
            @if($brochureDetail->tiles_type != 'default')
                <div class="section-title">
                    <h4 class="text-center" style="text-transform: uppercase;">{{ $brochureDetail->tiles_type }}</h4>
                </div>
            @endif
            <div class="image-container">
                    @foreach($brochureDetail->images  as $ik => $image)
                        @if($k!=0 && $k%6 == 0)
                            </div>
                        <div class="section-title" style="padding-top: 30px;">
                            <h4 class="text-center" style="text-transform: uppercase;">{{ $brochureDetail->tiles_type }}</h4>
                        </div>
                        <div class="image-container" >

                        @endif
                        <img class="content-50"
                         src="{!! $image->present()->image(350, 350) !!}"
                         alt="{{ $image->alt_attribute }}">
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
