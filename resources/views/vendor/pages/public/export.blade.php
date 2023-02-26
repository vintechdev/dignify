@extends('pages::public.master')

@section('page')
    <div class="layout">
        <main class="main main-inner" @if ($page->present()->image()) style="background-image: url({!! $page->present()->image() !!})" @endif data-stellar-background-ratio="0.6">
            <div class="container">
                <header class="main-header">
                    <h1>{{ $page->title }}</h1>
                </header>
            </div>
        </main>

        {!! $page->present()->body !!}

        @if($sections = $page->publishedSections()->get() and $sections->count() > 0)
            @foreach($sections as $section)
                {!! $section->present()->body !!}
            @endforeach
        @endif

        <div class="content">

        <section class="contacts section" >
            <div class="container">
                <div class="section-content">
                    <div class="row-base row">
                        <div class="col-base col-md-12">
                            @if($tabs = Blocks::render('export-tabs'))
                                {!! $tabs !!}
                            @endif
                            <div class="tab-content" id="pills-tabContent">
                                @if($exportEurope = Blocks::render('export-euro-pallets'))
                                    {!! $exportEurope !!}
                                @endif

                                @if($exportStandard = Blocks::render('export-standard-pallets'))
                                    {!! $exportStandard !!}
                                @endif

                            </div>
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
