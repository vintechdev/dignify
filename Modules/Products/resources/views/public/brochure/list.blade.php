@extends('pages::public.master')

@section('page')
    <div class="layout">
        <main class="main main-inner"
              @if ($page->present()->image()) style="background-position:left bottom; background-image: url({!! url('/img/cover/brochure-cover.jpg') !!})"
              @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>Brochures</h1>
                    <h2 class="text-white" style="color:white">
                        {{ $pageTitle }}</h2>
                </header>
            </div>
        </main>
        <div class="content">
            <section class="project-details">
                <div class="container">
                    <div class="row mb-2">
                        @foreach($brochures as $k => $brochure)
                            @php
                                $categoryTitleObject = json_decode($brochure['title'], true);
                                $title = ($categoryTitleObject['en']);
                            @endphp

                            @if($k!=0 && $k%4 == 0)
                            </div>
                            <div class="clearfix"></div>
                            <div class="row mb-2">

                            @endif

                             <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="ml-auto  d-block pt-2">
                                    <a class="d-block" download href="{{ url('storage/'. trim($brochure->file_url, '/'))  }}" style="display: block; text-align:center;">
                                        <img  class="ml-auto" style="max-height: 100px; width: auto;" alt="" src="{{ url('/img/cover/pdf-icon.png') }}"/>
                                        <h5 class="text-center">
                                            {{ $brochure->bTitle != '' && $brochure->bTitle != null ? $brochure->bTitle : $title . '-' . $brochure['tag']  }}
                                        </h5>
                                    </a>
                                </div>
                            </div>


                        @endforeach
                    </div>

                </div>
            </section>

            @include('contacts::public.contact-form')

            @section('site-footer')
                @include('core::public.footer')
            @show

        </div>
    </div>
@endsection
