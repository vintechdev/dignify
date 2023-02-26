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
            <section class="contact-details">
                <div class="col-base col-md-7 mb-50">
                    <header class="section-header mb-50">
                        <h2 class="section-title">Get <span class="text-primary">in touch</span></h2>
                    </header>
                    {!! BootForm::open()->action(route('post-contact'), ['class' => 'js-ajax-form'])->multipart() !!}
                    {!! Honeypot::generate('my_name', 'my_time') !!}
                    {!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}

                        <div class="row-field row">
                            <div class="col-field col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" required
                                           placeholder="Email *">
                                </div>
                            </div>
                            <div class="col-field col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone" required placeholder="Phone *">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="company"
                                           placeholder="Company">
                                </div>
                            </div>
                            <div class="col-field col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" name="message"
                                              placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-message col-field col-sm-12">
                                <div class="form-group">
                                    <div class="success-message"><i class="fa fa-check text-primary"></i>
                                        Thank you!. Your message is successfully sent...</div>
                                    <div class="error-message">We're sorry, but something went wrong</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-submit text-right"><button class="btn btn-shadow-2 wow swing">Send
                                <i class="icon-next"></i></button></div>
                    {!! BootForm::close() !!}
                </div>

                {!! $page->present()->body !!}

            </section>

            @if($sections = $page->publishedSections()->get() and $sections->count() > 0)
                @foreach($sections as $section)
                    {!! $section->present()->body !!}
                @endforeach
            @endif

            @section('site-footer')
                @include('core::public.footer')
            @show

        </div>
    </div>
@endsection
