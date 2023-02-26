@extends('core::admin.master')

@section('title', __('Product categories'))

@section('content')

<item-list
    url-base="/api/products/category-types"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,position,status,title"
    table="product_category_types"
    title="Category Types"
    include="image"
    appends="thumb"
    :searchable="['title']"
    :sorting="['position']">

    <template slot="back-button">
        @include('core::admin._button-back', ['module' => 'products'])
        <a href="{{ route('admin::index-product_categories') }}" class="btn btn-sm mr-2 btn-secondary">@lang('Categories')</a>
    </template>

    <template slot="add-button">
        @include('core::admin._button-create', ['module' => 'product_category_type'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox"></item-list-column-header>
        <item-list-column-header name="edit"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="position" sortable :sort-array="sortArray" :label="$t('Position')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Brouchures Image')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td>@include('core::admin._button-edit', ['segment' => 'category-types', 'module' => 'product_category_types'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><item-list-position-input :model="model"></item-list-position-input></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td>@{{ model.title_translated }}</td>
    </template>

</item-list>

@endsection
