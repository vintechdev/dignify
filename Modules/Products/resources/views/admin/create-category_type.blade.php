@extends('core::admin.master')

@section('title', __('New product category'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'product_category_types'])
        <h1 class="header-title">@lang('New Category Type')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::store-product_category_type'))->multipart()->role('form') !!}
        @include('products::admin._form-category_type')
    {!! BootForm::close() !!}

@endsection
