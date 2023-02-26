@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" data="{{ $model->image }}"></file-field>
<file-field type="image" label="Banner Image" field="banner_image_id" data="{{ $model->bannerImage }}"></file-field>
<file-field type="image" label="Home Category Image" field="home_image_id" data="{{ $model->homeImage }}"></file-field>


@include('core::form._title-and-slug')
{!! BootForm::select(__('Category Type'), 'category_type_id', ProductCategoryTypes::allForSelect())->required() !!}

<div class="form-group">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
</div>
