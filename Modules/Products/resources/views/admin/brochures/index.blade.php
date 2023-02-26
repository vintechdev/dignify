@extends('core::admin.master')

@section('title', __('Product Brouchers'))

@section('content')

<item-list
    url-base="/api/brochures"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,product_category_id,tag_id"
    table="brochures"
    title="brochures">

    <template slot="add-button">
        <a href="/admin/brochures/create" class="btn btn-primary btn-sm header-btn-add mr-2"><span class="fa fa-plus text-white-50"></span> Add</a>
    </template>

    <template slot="columns">
        <item-list-column-header name="checkbox"></item-list-column-header>
        <item-list-column-header name="edit"></item-list-column-header>
        <item-list-column-header name="title" :label="$t('Title')"></item-list-column-header>

        {{--   <item-list-column-header name="detail"></item-list-column-header>
        --}}   <item-list-column-header name="product_category_type" :label="$t('Product Category Type')"></item-list-column-header>
        <item-list-column-header name="product_category" :label="$t('Product Category')"></item-list-column-header>
        <item-list-column-header name="tag" :label="$t('Tag')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
            <td>@include('core::admin._button-edit', ['segment' => 'brochures', 'module' => 'brochures'])</td>
      {{--      <td><a :href="'/admin/brochure-details/'+model.id" class="btn btn-primary btn-xs">Details</a></td>
      --}}
        <td>@{{ model.title }}</td>
        <td>@{{ model.product_category.product_category_type.title['en']  }}</td>
        <td>@{{ model.product_category.title['en'] }}</td>
        <td>@{{ model.tag.tag }}</td>
    </template>

</item-list>

@endsection
