@extends('pages::public.master')

@section('bodyClass', 'body-teams body-teams-categories body-page body-page-'.$page->id)

@section('content')
    <div class="layout">
        <main class="main main-inner"
              @if ($page->present()->image()) style="background-image: url({!! $page->present()->image() !!})"
              @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $page->title }}</h1>
                </header>
            </div>
        </main>
        <div class="content">
            {!! $page->present()->body !!}

            <section class="clients section">
                <div class="container">
                    <header class="section-header">
                        <h2 class="section-title">Our <span class="text-primary">Team</span></h2>
                        <strong class="fade-title-left">Team</strong>
                    </header>

                    <div class="section-content certificates-content">
                        <div class="container">
                            <div class="row">
                                @foreach ($categories as $team)
								
								@php
								  list($f, $s) = explode(" ", $team->job_title);
								@endphp
                                <div class="col-md-3">
                                    <div class="t-img">
                                        <img src="{!! $team->present()->image(250, 380) !!}" class="img-responsive"
                                             width="" height="" alt="">
                                    </div>
                                    <div class="t-details">
                                        <h6 class="team-text">
                                            MR. {{ str_replace("Mr.", "", $team->name) }}
                                        </h6>
                                        <p class="t-designation ">{{ Str::upper($f) }}  {{ Str::title($s) }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
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
