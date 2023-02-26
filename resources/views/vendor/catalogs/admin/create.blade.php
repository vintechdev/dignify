@extends('core::admin.master')

@section('title', __('New catalog'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'catalogs'])
        <h1 class="header-title">@lang('New catalog')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-catalogs'))->multipart()->role('form') !!}
        @include('catalogs::admin._form')
    {!! BootForm::close() !!}

@endsection
