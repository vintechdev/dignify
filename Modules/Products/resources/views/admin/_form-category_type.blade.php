@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" label="Brochure Image" field="image_id" data="{{ $model->image }}"></file-field>
<file-field type="image" label="Banner Image" field="banner_image_id" data="{{ $model->bannerImage }}"></file-field>


@include('core::form._title-and-slug')

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(1) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    {!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
</div>
