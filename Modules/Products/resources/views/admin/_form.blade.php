@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>
@endpush

@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" data="{{ $model->image }}"></file-field>
<files-field :init-files="{{ $model->files }}"></files-field>

@include('core::form._title-and-slug')
<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>

{!! BootForm::select(__('Category'), 'category_id', ProductCategories::allForSelect())->required() !!}

{!! BootForm::text(__('Sizes'), 'tags')->value(old('tags') ? : implode(',', $model->tags->pluck('tag')->all())) !!}

{!! BootForm::text(__('Finishing Type'), 'finishing_type') !!}

{!! TranslatableBootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
