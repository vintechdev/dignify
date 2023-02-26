@extends('core::admin.master')

@section('title', __('New team'))

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'teams'])
        <h1 class="header-title">@lang('New team')</h1>
    </div>

    {!! BootForm::open()->action(route('admin::index-teams'))->multipart()->role('form') !!}
        @include('teams::admin._form')
    {!! BootForm::close() !!}

@endsection
