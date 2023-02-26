@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<div class="row team">
    <div class="col-md-6">
        {!! BootForm::text(__('Name'), 'name') !!}

    </div>
    <div class="col-md-6">
        {!! BootForm::text(__('Slug'), 'slug') !!}
    </div>
</div>


{!! TranslatableBootForm::text(__('Job Title'), 'job_title')->placeholder('Job Title') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" data="{{ $model->image }}"></file-field>

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

<div class="row">
    <div class="col-sm-6">
        {!! BootForm::date(__('Date'), 'date')->value(old('date') ? : $model->present()->dateOrNow('date'))->addClass('datepicker') !!}
    </div>
</div>

{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
