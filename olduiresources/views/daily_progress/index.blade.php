@extends('layouts.dashboard')
<style>

    #project-table  td, th {
        position: relative;
        text-align: center;
    }

    #project-table .hover{
        background-color: aliceblue;
    }

    .table-scroll {
        position:relative;
        margin:auto;
        overflow:hidden;

    }
    .table-wrap {
        width:100%;
        overflow:auto;
    }
    .table-scroll table {
        width:100%;
        margin:auto;
        border-collapse:separate;
        border-spacing:0;
    }
    .table-scroll th, .table-scroll td {
        /*padding:5px 10px;*/
        /*border:1px solid #fff;*/

        white-space:nowrap;
        vertical-align:top;
    }

    .clone {
        position:absolute;
        top:0;
        left:0;
        pointer-events:none;
    }
    .clone th, .clone td {
        visibility:hidden
    }
    .clone .fixed-side {
        background:rgb(255, 255, 255);
        visibility:visible;
    }
</style>

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
                         @if((in_array('create-daily-progress', getUserPermissions())))
                            <div class="nk-block-head-content">
{{--                                <a href="{{ route("daily_target.create") }}" class="btn btn-primary">Add New {{ $section->heading }}</a>--}}
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="color: #fff;">Add New {{ $section->heading }}</a>
                            </div><!-- .nk-block-head-content -->
                            @endif
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview">
                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview">
                            <div class="card-inner">
                            {!! Form::model($progress, ['method' => $section->method, 'route' => $section->route, 'class' => 'form-validate', ]) !!}
                                <div class="row align-items-end">
                                    @if((auth()->user()->user_type != 8) && (auth()->user()->user_type != 9))
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-topics">Developer</label>
                                            <div class="form-control-wrap ">
                                                {!! Form::select('name', $devUsers, $name, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6">
                                     <div class="form-group">
                                        <label class="form-label">Range:</label>
                                        <div class="form-control-wrap">
                                        <div class="input-daterange date-picker-range input-group">
                                         {!! Form::text('date_from', $date_from, ['class' => 'form-control target-datepicker', 'placeholder' => 'Enter From Date']) !!}
                                            <div class="input-group-addon">TO</div>
                                         {!! Form::text('date_to', $date_to, ['class' => 'form-control target-datepicker', 'placeholder' => 'Enter To Date']) !!}
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                     {!! Form::button('<i class="fa fa-check-square-o"></i> Search', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>


                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="table-responsive">
                                        <div id="table-scroll" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table-bordered  table-condensed   table table-hover  main-table  ">
                                                    <tr>
                                                        <th class="fixed-side project-title" >Developer <br/>Name  </th>
                                                        @foreach($timePeriod as $key => $value)
                                                        <th style="text-align: center;"> {{ $value->format('d-M') }}<br/> {{ $value->format('D') }}</th>
                                                        @endforeach
                                                    </tr>

                                                    @foreach($progress->groupBy(['user_id', 'date'])->toArray() as $key => $bidderDates)
                                                    <tr>
                                                        <td class="fixed-side"> {{ getUserDetail($key)->name }} </td>
                                                        @foreach($timePeriod as $timePeriodkey => $dateNormal)
                                                            <td>
                                                                @php $time = 0; @endphp
                                                            @foreach($bidderDates as $bidderKey => $bidderDate)
                                                                    @if($dateNormal->format('Y-m-d') == $bidderKey)
                                                                        @foreach($bidderDate as $bidder)
                                                                            @php $time += $bidder['time'] @endphp
                                                                        @endforeach
                                                                        <a href="{{ route('daily_progress.dayReport',  [$key, $bidderKey]) }}">{{ getHrsMins($time) }}</a>
                                                                        @continue
                                                                    @else
{{--                                                                        {{ $bidderKey }}--}}
                                                                    @endif



                                                            @endforeach
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        </div>

{{--                        <div class="nk-block nk-block-lg">--}}
{{--                            <div class="card card-preview">--}}
{{--                                <div class="card-inner">--}}

{{--                                    <table class="datatable-init nowrap table">--}}

{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>ID</th>--}}
{{--                                            <th>Link</th>--}}
{{--                                            <th>Is Chat Opened ?</th>--}}
{{--                                            <th>Is Sale Opened ?</th>--}}
{{--                                            <th>Date</th>--}}
{{--                                            <th>Bidder</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @if( $targets )--}}
{{--                                            @foreach( $targets as $target )--}}
{{--                                                <tr id="rowID-{{ $target->id }}">--}}
{{--                                                    <td>{{ $target->id }}</td>--}}
{{--                                                    <td>{{$target->bid_link}}</td>--}}
{{--                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>--}}
{{--                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>--}}
{{--                                                    <td>{{ $target->bid_date }}</td>--}}
{{--                                                    <td>{{ $target->user->name }}</td>--}}
{{--                                                    <td>--}}
{{--                                                   @if((in_array('update-daily-target', getUserPermissions())))--}}
{{--                                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                            <a class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>--}}
{{--                                                        </div>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div><!-- .card-preview -->--}}
{{--                        </div> <!-- nk-block -->--}}
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
{{--                                <label class="form-label" for="fv-topics">Select Project</label>--}}
{{--                                <div class="form-control-wrap ">--}}
{{--                                    {!! Form::select('project_id', $projects , null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option' ]); !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-group row">
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
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
       // For stickey column
       $(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
    });
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '1d'
    });

   $('.target-datepicker').datepicker({
       format: 'yyyy-mm-dd',
       // startDate: '-3d'
       endDate: '1d'
   });
   $('.bidder-datepicker').datepicker({
       format: 'yyyy-mm-dd',
       endDate: '1d'
   });
</script>
@endsection
