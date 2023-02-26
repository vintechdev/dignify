@extends('core::admin.master')

@section('title', __('Brochure Detail'))

@section('content')

    <h2 class="page-title"> Brochure Details </h2>

    <div class="item-list">
        <div class="item-list-header header"><h1 class="item-list-title header-title">
                {{ $brochure->productCategory->title }}-{{ $brochure->tag->tag }}
            </h1>
            <div class="item-list-toolbar header-toolbar btn-toolbar">
                <a href="/admin/brochure-details/{{ $brochure->id }}/create"
                   class="btn btn-primary btn-sm header-btn-add mr-2"><span
                        class="fa fa-plus text-white-50"></span> Add</a></div>
        </div>

        <div class="table-responsive">
            <table class="table item-list-table">
                <thead>
                <tr>
                    <th class="" width="150px"><span>Action</span></th>
                    <th class="title_translated"><span>Type</span></th>
                </tr>
                </thead>
                <tbody>

                    @foreach($rows as $brochureDetail)
                        <tr>
                            <td>

                                <form action="{{ route('admin::delete-brochure-detail', $brochureDetail->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="/admin/brochure-details/{{  $brochureDetail->id }}/edit"
                                       class="btn btn-light btn-xs mr-2">Edit</a>
                                    <button class="btn btn-danger btn-xs" type="submit">Delete</button>

                                </form>
                            </td>
                            <td>{{ $brochureDetail->tiles_type }}</td>
                        </tr>
                    @endforeach

                    @if(!$rows->count())
                        <tr>
                            <td colspan="2">There are no rows.</td>
                        </tr>
                    @endif
                </tbody>

            </table>
        </div>

    </div>
@endsection
