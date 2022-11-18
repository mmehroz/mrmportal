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
                             @if((in_array('create-team', getUserPermissions())))
                            <div class="nk-block-head-content">
                                <a href="{{ route("teams.create") }}" class="btn btn-primary">Add New {{ $section->title }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
                            @if((in_array('create-reports', getUserPermissions())))
                            <div class="nk-block-head-content">
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="color: #fff;">Generate Sales Report</a>
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
                                            <th>Team Lead</th>
                                            <th>Team Members</th>
                                            <th>Team Target</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $team_members )
                                            @foreach( $team_members as $team_member )
                                                <tr id="rowID-{{ $team_member->id }}">
                                                    <td>{{ $team_member->id }}</td>
                                                    <td>{{ $team_member->name }}</td>
                                                    <td><span class="badge badge-dim badge-primary">{{ getTeamLead($team_member->id)['team_lead']['name'] }}</span></td>
                                                    <td>
                                                         @if($team_member->teamMembers)
                                                             @foreach($team_member->teamMembers as $key => $team_member_user)
                                                                @if($team_member_user->is_lead == 0)

                                                                @foreach($team_member_user->user as $user)
                                                                <span class="badge badge-dim badge-info">{{ $user->name ?? 'n/a' }}</span>
                                                                {!! $key == 1 ? '<br>' : ''!!}
                                                                @endforeach
                                                                @else
                                                                @continue;
                                                                @endif
                                                             @endforeach
                                                         @endif
                                                    </td>
                                                    <td>{!! getAmountFormat($team_member->team_target)  !!}</td>
                                                    <td>
                                                    @if((in_array('update-team', getUserPermissions())))
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-primary" href='{{ route("teams.edit", $team_member->id) }}'><em class="icon ni ni-edit"></em></a>
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

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Generate Team Report</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('teams.generateReport') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-topics">Select Team</label>
                                <div class="form-control-wrap ">
                                    {!! Form::select('team_id', $team_members->pluck('name', 'id'), 0, ['class' => 'form-control select2', 'placeholder' => 'Select a option']); !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Start Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('start_date', null, ['class' => 'form-control  start-datepicker', 'placeholder' => 'Enter Start Date ', 'required' => 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">End Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('end_date', null, ['class' => 'form-control  end-datepicker', 'placeholder' => 'Enter End Date ', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
