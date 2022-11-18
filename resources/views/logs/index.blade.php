@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">  {{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">

                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div>


                    <div class="components-preview  mx-auto">
                        <!-- main alert @s -->
                        @include('partials.alerts')
                        <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th>Subject Type</th>
                                            <th>Subject ID</th>
                                            <th>User</th>
                                            <th>Message</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $logs )
                                            @foreach( $logs as $log )
                                                <tr id="rowID-{{ $log->id }}">
                                                    <td>{{$log->id }}</td>
                                                    <td>{{ date('d-M-y', strtotime($log->created_at)) }}</td>
                                                    <td>{{ date('H s:i A', strtotime($log->created_at)) }}</td>
                                                    <td>{{ ucfirst($log->description) }}</td>
                                                    <td>{{$log->subject_type}}</td>
                                                    <td>{{$log->subject_id}}</td>
                                                    <td>{{$log->causer_id}}</td>
                                                    <td>{{$log->properties}}</td>
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
