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
                         @if((in_array('create-profile', getUserPermissions())))
                            <div class="nk-block-head-content">
                                <a href="{{ route("profiles.create") }}" class="btn btn-primary">Add New {{ $section->title }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
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
                                            <th>Status</th>
                                            <th>JSS Record</th>
                                            <th>Bid Purchase Record</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $profiles )
                                            @foreach( $profiles as $profile )
                                                <tr id="rowID-{{ $profile->id }}">
                                                    <td>{{ $profile->id  }}</td>
                                                    <td>{{$profile->name}}</td>
                                                    <td>{!!($profile->status == 0) ? '<span class="badge badge-dim badge-danger">Inactive</span>' : '<span class="badge badge-dim badge-success">Active</span>'!!}</td>
                                                    <td>
                                                        {{ (getProfileJss($profile->id)) ? getProfileJss($profile->id) : 0 }} %
                                                        <a class="" href='{{ route("profiles.jss", $profile->id) }}'>View Records</a>
                                                    </td>
                                                    <td>
                                                        <a class="" href='{{ route("profiles.bdlog", $profile->id) }}'>View Records</a>
                                                    </td>
                                                    <td>
                                                         @if((in_array('update-profile', getUserPermissions())))
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-primary" href='{{ route("profiles.edit", $profile->id) }}'><em class="icon ni ni-edit"></em></a>
                                                        </div>
                                                        @endif
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

@push('scripts')z
@endpush
