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
                           @if((in_array('create-user', getUserPermissions())))
                            <div class="nk-block-head-content">
                                <a href="{{ route("users.create") }}" class="btn btn-primary">{{ $section->heading }}</a>
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
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $customers )
                                            @foreach( $customers as $customer )
                                                @if($customer->user_type == 0)
                                                    @continue
                                                @endif
                                                <tr id="rowID-{{ $customer->id }}">
                                                    <td>{{ $customer->id }}</td>
                                                    <td>{{$customer->name}}</td>
                                                    <td>{{$customer->email}}</td>
                                                    <td>{!!($customer->status == 0) ? '<span class="badge badge-dim badge-danger">Block</span>' : '<span class="badge badge-dim badge-success">Active</span>'!!}</td>
                                                    <td>{{ucfirst($customer->role->name)}}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            @if(in_array('update-user', getUserPermissions()))
                                                            <a class="btn btn-primary" href='{{ route("users.edit", \Illuminate\Support\Facades\Crypt::encrypt($customer->id))  }}'><em class="icon ni ni-edit"></em></a>
                                                            @endif
                                                            @if(in_array('delete-user', getUserPermissions()))
                                                         {{--    <a class="btn btn-danger deleteBtnModal" data-id="{{$customer->id}}" data-route="" data-toggle="modal" data-target="#deleteModal" style="color:#fff;"><em class="icon ni ni-trash"></em></a> --}}
                                                            @endif
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
