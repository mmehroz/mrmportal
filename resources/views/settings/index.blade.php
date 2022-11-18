@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <a href="{{ route("category.create") }}" class="btn btn-primary">Add New {{ $section->title }}</a>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Sorting Order</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $categories )
                                            @foreach( $categories as $category )
                                                <tr id="rowID-{{ $category->id }}">
                                                    <td>{{$category->id }}</td>
                                                    <td>{{$category->name}}</td>
                                                    <td>{{$category->sorting_order}}</td>
                                                    <td>{!!($category->status == 0) ? '<span class="badge badge-danger">Inactive</span>' : '<span class="badge badge-success">Active</span>'!!}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-primary" href='{{ route("category.edit", $category->id) }}'><em class="icon ni ni-edit"></em></a>
{{--                                                            <a class="btn btn-danger deleteBtnModal" data-id="{{$category->id}}" data-route="{{route('category.destroy', $category->id)}}" data-toggle="modal" data-target="#deleteModal" style="color:#fff;"><em class="icon ni ni-trash"></em></a>--}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
