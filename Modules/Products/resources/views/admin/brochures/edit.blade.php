@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'brochures'])
        <h1 class="header-title">
            Edit Brochure
        </h1>
    </div>

    {!! BootForm::open()->post()->action(route('admin::update-brochures', $model->id))
    ->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('products::admin.brochures._form')
    {!! BootForm::close() !!}

@endsection
