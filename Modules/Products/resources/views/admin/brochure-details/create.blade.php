@extends('core::admin.master')

@section('title', __('New Brochure Details'))

@section('content')

    <div class="header">
        <h1 class="header-title">@lang('Add Brochure Images')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::store-brochure-details', $brochure->id))->multipart()->role('form') !!}
            @include('products::admin.brochure-details._form')
    {!! BootForm::close() !!}

@endsection
