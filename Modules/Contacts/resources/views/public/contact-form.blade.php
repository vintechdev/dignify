<section class="contacts section">
    <div class="container">
        <header class="section-header">
            <h2 class="section-title">Get <span class="text-primary">in touch</span></h2>
            <strong class="fade-title-right">Contact</strong>
        </header>
        <div class="section-content">
            <div class="row-base row">
                <div class="col-address col-base col-md-4">
                    <div><span class="fa fa-phone">&nbsp;</span>Export: +91 982 586-85-00 </div>
                    <div><span class="fa fa-phone">&nbsp;</span>Domestic: +91 972 580-33-33</div>
                    <a href="mailto:info@dignifykeramos.com" class="__cf_email__"
                       data-cfemail="">info@dignifykeramos.com</a><br>
					<a href="mailto:expokdignify@gmail.com" class="__cf_email__"
                       data-cfemail="">expokdignify@gmail.com</a><br>   
					   B-61,62 Real Plaza, 8-A National Highway
                    Morbi-363641, Gujarat (India)
                </div>
                <div class="col-base  col-md-8">
                    {!! BootForm::open()->action(route('post-contact'))->multipart() !!}
                    {!! Honeypot::generate('my_name', 'my_time') !!}
                    {!! BootForm::hidden('locale')->value(isset($model->locale) ? $model->locale : config('app.locale')) !!}

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @lang('message when errors in form').
                            <ul class="mb-0">
                                @foreach ($errors->all() as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row-field row">
                            <div class="col-field col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" required placeholder="Name *">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" required
                                           placeholder="Email *">
                                </div>
                            </div>
                            <div class="col-field col-sm-6 col-md-4">
                                <div class="form-group">
                                    <input type="tel" class="form-control" name="phone_number" required placeholder="Phone *">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="company_name"
                                           placeholder="Company">
                                </div>
                            </div>
                            <div class="col-field col-sm-12 col-md-4">
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
                        <div class="form-submit text-right">
                            <button type="submit" class="btn btn-shadow-2 wow swing">{{ __('Send') }} <i class="icon-next"></i></button>
                        </div>
                    {!! BootForm::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
