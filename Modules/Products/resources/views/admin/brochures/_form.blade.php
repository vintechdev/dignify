@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

{!! BootForm::hidden('id') !!}

{!! BootForm::text(__('Title'), 'title'); !!}

{!! BootForm::select(__('Product Category'), 'product_category_id', ['' => 'Select Category'] + $categories)->required() !!}

{!! BootForm::select(__('Size'), 'tag_id', ['' => 'Select size'] + $tags)->required() !!}

<div class="form-group">
    <label for="url" class="control-label-required">Brochure Link</label>
    <input type="url" name="url" class="form-control"  />
</div>

<div class="form-group">
    <label for="files=" class="control-label-required">Files</label>
    <input type="file" name="file" class="form-control pl-0" accept=".pdf" style="border:0;" />
</div>
