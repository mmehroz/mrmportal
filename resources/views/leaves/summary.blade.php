<style>
thead tr th {
    line-height: 55px !important;
}

thead {
    background: #F6F8FC;
}

.dark-mode  thead {
    background: #59595A;
}


</style>

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
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview  mx-auto">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="nowrap table">
                                        <thead>
                                        <tr>
                                            <th>Emp id</th>
                                            <th>Employee Name</th>
                                            <th>Total Leaves</th>
                                            <th>Availed</th>
                                            <th>Applied</th>
                                            <th>Available</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $users )
                                            @foreach( $users as $user )
                                                <tr id="rowID-{{ $user->id }}">
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ ($user->no_of_leaves) ? $user->no_of_leaves : 0 }}</td>
                                                    <td>{{ $availedLeaves = getUserAvailedLeaves($user->id) }}</td>
                                                    <td>{{ $appliedLeaves = getUserAppliedLeaves($user->id) }}</td>
                                                    <td>{{ $user->no_of_leaves - $availedLeaves }}</td>
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
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });


        $('.start-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '-3d'
            endDate: '1d'
        });
        $('.end-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '1d'
        });
    </script>
@endpush
