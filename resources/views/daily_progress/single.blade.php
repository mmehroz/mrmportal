

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
                                        <li class="breadcrumb-item"><a href="{{ route("daily_progress.index") }}">{{ $section->title }}</a></li>
                                        <li class="breadcrumb-item active">Day Report</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->
                         @if((in_array('create-daily-progress', getUserPermissions())))
                            <div class="nk-block-head-content">
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="color: #fff;">Add New {{ $section->heading }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview">

                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">

                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Project</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $progress )
                                            @foreach( $progress as $value )
                                                <tr id="rowID-{{ $value->id }}">
                                                    <td>{{ $value->id }}</td>
                                                    <td >{{$value->project_id}}</td>
                                                    <td>{{$value->date}}</td>
                                                    <td> {{ getHrsMins($value->time) }}</td>
                                                    <td>{{$value->description}}</td>
                                                    <td>
                                                   @if((in_array('update-daily-progress', getUserPermissions())))
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn " href='{{ route("daily_progress.edit",  \Illuminate\Support\Facades\Crypt::encrypt($value->id)) }}'><img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" > </a>
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
                    <h5 class="modal-title">Add New {{ $section->heading }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('daily_progress.store') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
{{--                            <div class="col-md-12">--}}
{{--                                <label class="form-label" for="fv-topics">Project</label>--}}
{{--                                <div class="form-control-wrap ">--}}
{{--                                    {!! Form::select('project_id', $projects , null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-12">
                                <label class="form-label" for="fv-topics">Trello Link</label>
                                <div class="form-control-wrap ">
                                    {!! Form::text('trello_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Trello Link ']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter Date ', 'required' => 'required', ]) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                               <label class="form-label" for="fv-full-name">Time</label>
                                                    <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::select('time_hrs', array('0' => 0, '1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'10' => 10,'11' => 11,'12' => 12 ) , null, ['class' => 'form-control form-select select2', 'placeholder' => 'Hours', 'required' => 'required', ]) !!}
                                                    </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::select('time_mins', array('0' => 0, '1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19,'20' => 20,'21' => 21,'22' => 22,'23' => 23,'24' => 24,'25' => 25,'26' => 26,'27' => 27,'28' => 28,'29' => 29,'30' => 30, '31' => 31,'32' => 32,'33' => 33,'34' => 34,'35' => 35,'36' => 36,'37' => 37,'38' => 38,'39' => 39,'40' => 40, '41' => 41,'42' => 42,'43' => 43,'44' => 44,'45' => 45,'46' => 46,'47' => 47,'48' => 48,'49' => 49,'50' => 50,'51' => 51,'52' => 52,'53' => 53,'54' => 54,'55' => 55,'56' => 56,'57' => 57,'58' => 58,'59' => 59) ,null, ['class' => 'form-control form-select select2 ', 'placeholder' => 'Mins', 'required' => 'required', ]) !!}
                                                    </div>

                                                    </div>
                                                    </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                  <label class="form-label" for="fv-full-name">Description</label>
                                <div class="form-control-wrap">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'required' => 'required', ]) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $('.select2').select2();
    });

      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '1d'
    });
</script>
@endsection
