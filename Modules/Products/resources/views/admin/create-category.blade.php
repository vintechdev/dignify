@extends('core::admin.master')

@section('title', __('New product category'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'product_categories'])
        <h1 class="header-title">@lang('New product category')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-product_categories'))->multipart()->role('form') !!}
        @include('products::admin._form-category')
    {!! BootForm::close() !!}

@endsection
