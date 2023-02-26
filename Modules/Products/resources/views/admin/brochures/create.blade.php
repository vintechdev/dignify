@extends('core::admin.master')

@section('title', __('New Brochures'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'brochures'])
        <h1 class="header-title">@lang('New Brochures')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-brochures'))->multipart()->role('form') !!}
        @include('products::admin.brochures._form')
    {!! BootForm::close() !!}

@endsection
