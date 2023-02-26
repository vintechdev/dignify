@component('core::admin._buttons-form', ['model' => $model])
@endcomponent

<h2>{{ $brochure->productCategory->title }} - {{ $brochure->tag->tag }}</h2>

{!! BootForm::hidden('id') !!}
{!! BootForm::hidden('brochure_id', $brochure->id) !!}

{!! BootForm::select(__('Type'), 'tiles_type', [
    'default' => 'Default',
    'GLOSSY' => 'GLOSSY',
    'HIGH-GLOSSY' => 'HIGH GLOSSY',
    'MATT' => 'MATT'
])->required() !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<files-field :init-files="{{ $model->files }}"></files-field>
{{--
<div class="form-group">
    <label for="files=" class="control-label-required">Files</label>
    <input type="file" name="file" class="form-control pl-0" accept=".pdf" required style="border:0;" />
</div>--}}

