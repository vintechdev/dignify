@extends('core::admin.master')

@section('title', $model->present()->title)

@section('content')

    <div class="header">
      {{--  @include('core::admin._button-back', ['module' => 'brochure-details'])
      --}}  <h1 class="header-title">
            Edit Brochure Details
        </h1>
    </div>

    {!! BootForm::open()->put()->action(route('admin::update-brochure-details', $model->id))->multipart()->role('form') !!}
    {!! BootForm::bind($model) !!}
        @include('products::admin.brochure-details._form')
    {!! BootForm::close() !!}

@endsection
