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
        <div class="content">
            <!--@if($productCategoryTypes = \TypiCMS\Modules\Products\Models\ProductCategoryType::published()->get() and $productCategoryTypes->count() > 0)
            <section class="contacts section" >
                <div class="container">
                    {!! $page->present()->body !!}
                    <div class="section-content">
                        <div class="row-base row">
                            <div class="col-base col-md-12">
                                <ul class="nav nav-pills mb-1" id="pills-tab" role="tablist">
                                    @foreach($productCategoryTypes as $key => $productCategoryType)
                                        <li class="nav-item {{ $key == 0 ? 'active' : '' }}">
                                            <a class="nav-link {{ $key == 0 ? 'active' : '' }}"
                                               id="pills-{{ $productCategoryType->slug  }}-tab"
                                               data-toggle="pill"
                                               href="#pills-{{ $productCategoryType->slug  }}"
                                               role="tab" aria-controls="pills-{{ $productCategoryType->slug }}"
                                               aria-selected="true">{{ $productCategoryType->title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    @foreach($productCategoryTypes as $key => $productCategoryType)
                                    <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="pills-{{ $productCategoryType->slug  }}" role="tabpanel"
                                         aria-labelledby="pills-{{ $productCategoryType->slug  }}-tab">
                                        <div class="table-responsive">
                                             {!! $productCategoryType->body !!}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
			-->
			<section class="contacts section" >
				{!! $page->present()->body !!}
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
