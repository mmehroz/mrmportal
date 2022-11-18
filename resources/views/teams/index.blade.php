<style>
    .modal-backdrop {
   width: unset !important;
    } 

    #users-frm .select2 {
    display: block !important;
}


.modal-content {
    padding: 20px 15px 15px 10px;
}


.form-label {color: #414042 !important; }


@media only screen and (max-width:600px) {

.nk-block-between {
    flex-flow: column;
}



.nk-block-between {
    display: flex;
    justify-content: center;
    align-items: center;
}

a.btn.btn-primary.generate-btn {
    margin-bottom: 10px;
    margin-top: 15px;
}

.add-team {
    position: inherit !important;
}

h2.nk-block-title.fw-normal {
    margin-bottom: 14px;
    text-align: center;
    margin-top: -15px;
}

}



.card.card-preview div#DataTables_Table_0_filter {
    float: right;
    margin-right: -100%;
  position: relative;
  z-index: 99;
}

.card.card-preview div#DataTables_Table_0_length {
  position: absolute;
  bottom: 15px;
  right: 120px;
}

.card.card-preview .card.card-preview .row.justify-between.g-2 {
    position: unset;
}

.card.card-preview .col-5.col-sm-6.text-right {
    position: unset;
    z-index:9;
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
                                
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                                <h2 class="nk-block-title fw-normal">  {{ $section->title }}</h2>

                            </div><!-- .nk-block-head-content -->
                             @if((in_array('create-team', getUserPermissions())))
                            <div class="nk-block-head-content">
                                <a data-toggle="modal" data-target="#myModalCreate" onclick="createteam()" class="btn btn-primary add-team ">Add New {{ $section->title }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
                            @if((in_array('create-reports', getUserPermissions())))
                            <div class="nk-block-head-content">
                            <a data-toggle="modal" data-target="#myModal" class="btn btn-primary generate-btn" style="color: #fff;">Generate Sales Report</a>
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
                               <div class ="innertable"> 

                                   
                                    <table class="datatable-init nowrap table ">
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
                                                    <td><span class="badge badge-dim badge-primary team-lead">{{ getTeamLead($team_member->id)['team_lead']['name'] }}</span></td>
                                                    <td>
                                                         @if($team_member->teamMembers)
                                                             @foreach($team_member->teamMembers as $key => $team_member_user)
                                                                @if($team_member_user->is_lead == 0)

                                                                @foreach($team_member_user->user as $user)
                                                                <span class="badge badge-dim badge-info team-member">{{ $user->name ?? 'n/a' }}</span>
                                                                {!! $key == 1 ? '' : ''!!}
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
                                                            <a class="btn" onclick="editteam({{$team_member->id}})"> <img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" >  </a>
                                                        </div>
                                                    @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                    </div>    

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
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id ='modals'></div>
    <!-- /.modal -->
@endsection

@push('scripts')
    <script>
        function createteam(){
         $('.row.justify-between.g-2').remove();
         $('.row.align-items-center').remove();
          $.get('{{ route("teams.create")}}',function(data){
          $('#modals').empty().append(data);
          $('#myModalCreate').modal('show');
          });
        }
        function editteam($id){
         $('.row.justify-between.g-2').remove();
         $('.row.align-items-center').remove();
          $.get('{{ URL::to("dashboard/teams")}}/'+$id+"/edit",function(data){
          $('#modals').empty().append(data);
          $('#myModalEdit').modal('show');
          });
        }
        
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
