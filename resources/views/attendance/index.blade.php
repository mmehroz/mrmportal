<style>
    .card.card-preview thead th {
    background: #F6F8FC;
    line-height: 65px !important;
}

.carcd.card-preview {
    padding-top: 30px;
}

.attendence-btable {
    padding-top: 15px !important;
}

.row.align-items-end {
    justify-content: flex-end;
    margin-right: 30px;
}

.components-preview.mx-auto.background-color {
    background: #F6F8FC;
    border-radius: 20px;
}

.background-color .carcd.card-preview {
    border-radius: 20px;
}


@media only screen and (max-width:600px) {

.nk-block-between {
    flex-flow: column;
}

.nk-block-head-content {
    text-align: center;
}

a.btn.btn-primary {
    margin-top: 15px;
}


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
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">

                                @if((in_array('upload-attendance', getUserPermissions())))
                                    <a href="{{ route("add.attendance") }}"
                                       class="btn btn-primary">Upload {{ $section->title }} Sheet</a>
                                @endif

                                @if((in_array('create-attendance', getUserPermissions())))
                                    <a href="{{ route("attendance.create") }}" class="btn btn-primary">Create
                                        New {{ $section->title }} </a>
                                @endif

                            </div><!-- .nk-block-head-content -->


                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                @include('partials.alerts')
                <!-- main alert @e -->

                    <div class="components-preview  mx-auto background-color">
                        <div class="nk-block  nk-block-lg attendence-table">
                            <div class="carcd card-preview">
                                <div class="card-inner">
                                    {!! Form::model($attendance, ['method' => $section->method, 'route' => $section->route, 'class' => 'form-validate', ]) !!}
                                    <div class="row align-items-end">
                                        @if((auth()->user()->user_type === 1) || (auth()->user()->user_type === 3) || (auth()->user()->user_type === 7) || (auth()->user()->user_type === 0))
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('name', $users,  $name, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option']); !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="input-daterange date-picker-range input-group">
                                                        {!! Form::text('date_from', $date_from, ['class' => 'form-control target-datepicker', 'placeholder' => 'Enter From Date']) !!}
                                                        <div class="input-group-addon">TO</div>
                                                        {!! Form::text('date_to', $date_to, ['class' => 'form-control bidder-datepicker', 'placeholder' => 'Enter To Date']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            {!! Form::button('<i class="fa fa-check-square-o"></i> Search', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>


                        <div class="nk-block nk-block-lg attendence-btable">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <table class="nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Name</th>
                                            <th>Routine Check In</th>
                                            <th>Routine Check Out</th>

                                            <th>Check In</th>
                                            <th>Check Out</th>
                                            <th>Late</th>

                                            <th>Working Hours</th>
                                            <th>Total Hours</th>
                                            <th>Status</th>
                                            <th>Updated By</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @if( $attendance )
                                            @php $wh = $th = 0;
                                                $routineTime = 0;
                                                $workingTime = 0;
                                            @endphp
                                            @foreach($timePeriod as $key => $value)
                                                @if(array_key_exists($value->format('Y-m-d'), $attendance))
{{--                                                    <th style="text-align: center;"> {{ $value->format('Y-m-d') }}<br/> {{ $value->format('D') }}</th>--}}
                                                    @if(@sizeof($attendance[$value->format('Y-m-d')]) != 0)
{{--                                                        {{ $value->format('Y-m-d') }} - {{'Array Have Records '}} {{ $attendance[$value->format('Y-m-d')][0]['routine_check_in'] }} <br/>--}}
                                                        @if($attendance[$value->format('Y-m-d')][0]['is_leave'] == 1)
                                                        <tr style="background-color: #000;color: #fff;">
                                                            <td></td>
                                                            <td>{{ $value->format('Y-m-d') }}</td>
                                                            <td colspan="12" style="text-align: center;"> Leave </td>
                                                        </tr>
                                                        @elseif($attendance[$value->format('Y-m-d')][0]['is_holiday'] == 1)
                                                        <tr style="background-color: #000;color: #fff;">
                                                            <td></td>
                                                            <td>{{ $value->format('Y-m-d') }}</td>
                                                            <td colspan="12" style="text-align: center;">{{ $attendance[$value->format('Y-m-d')][0]['is_holiday_detail'] ?? "" }}</td>
                                                        </tr>
                                                        @else
                                                        <tr id="rowID-{{ $attendance[$value->format('Y-m-d')][0]['id'] }}">
                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['id'] }}</td>
                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['date'] }}</td>
                                                            <td>{{ $value->format('l') }}</td>
                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['user']['name'] ?? "" }}</td>

                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['routine_check_in']}}</td>
                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['routine_checkout']}}</td>

                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['today_check_in']}}</td>
                                                            <td>{{ $attendance[$value->format('Y-m-d')][0]['today_check_out']}}</td>
                                                            <td>
                                                                @if( $attendance[$value->format('Y-m-d')][0]['is_late'] == "1")
                                                                    <span class="badge badge-danger">Yes</span>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                {{ getWorkingHoursSheet($attendance[$value->format('Y-m-d')][0]['routine_check_in'],$attendance[$value->format('Y-m-d')][0]['routine_checkout'])  }}
                                                                @php $routineTime += getTimeTotal($attendance[$value->format('Y-m-d')][0]['routine_check_in'],$attendance[$value->format('Y-m-d')][0]['routine_checkout']) @endphp
                                                            </td>
                                                            <td>
                                                                {{ getWorkingHoursSheet($attendance[$value->format('Y-m-d')][0]['today_check_in'],$attendance[$value->format('Y-m-d')][0]['today_check_out'])  }}
                                                                @php $workingTime += getTimeTotal($attendance[$value->format('Y-m-d')][0]['today_check_in'],$attendance[$value->format('Y-m-d')][0]['today_check_out']) @endphp
                                                            </td>
                                                            <td>
                                                                @if($attendance[$value->format('Y-m-d')][0]['status'] == 1)
                                                                    <span class="badge badge-success">Approve</span>
                                                                @else
                                                                    <span class="badge badge-danger">Pending</span>
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @php

                                                                    $user = getUserDetail($attendance[$value->format('Y-m-d')][0]['update_by']);
                                                                    if($user){
                                                                        echo ucfirst($user->name);
                                                                    }

                                                                @endphp
                                                            </td>
                                                            <td>
                                                                @if((in_array('update-attendance', getUserPermissions())))
                                                                    @if($attendance[$value->format('Y-m-d')][0]['status'] == 1)
                                                                        <div class="btn-group" role="group"
                                                                             aria-label="Basic example">
                                                                            <a class="btn btn-primary"
                                                                               href="{{ route("edit.attendance", \Illuminate\Support\Facades\Crypt::encrypt($attendance[$value->format('Y-m-d')][0]['id']))  }}"><em
                                                                                    class="icon ni ni-edit"></em></a>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @else
                                                        @if(($value->format('D') == 'Sun') || ($value->format('D') == 'Sat'))
                                                        <tr style="background-color: #eaeaea">
                                                            <td></td>
                                                            <td>{{ $value->format('Y-m-d') }}</td>
                                                            <td colspan="12" style="text-align: center;">{{ $value->format('l') }}</td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td></td>
                                                            <td>{{ $value->format('Y-m-d') }}</td>
                                                            <td>{{ $value->format('l') }} </td>
                                                            <td colspan="11"></td>
                                                        </tr>
                                                        @endif
                                                    @endif

                                                @else
                                                    <th style="text-align: center;"> {{ $value->format('l') }} </th>
                                                @endif
                                            @endforeach

                                            @foreach( $attendance as $key => $attendance )
{{--                                                <tr id="rowID-{{ $attendance->id }}">--}}
{{--                                                    <td>{{ $attendance->id }}</td>--}}
{{--                                                    <td>{{ $attendance->user->name ?? "" }}</td>--}}
{{--                                                    <td>{{$attendance->date}}</td>--}}

{{--                                                    <td>{{$attendance->routine_check_in}}</td>--}}
{{--                                                    <td>{{$attendance->routine_checkout}}</td>--}}

{{--                                                    <td>{{$attendance->today_check_in}}</td>--}}
{{--                                                    <td>{{$attendance->today_check_out}}</td>--}}
{{--                                                    <td>--}}
{{--                                                        @if($attendance->is_late == "1")--}}
{{--                                                            <span class="badge badge-danger">Yes</span>--}}
{{--                                                        @endif--}}

{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ getWorkingHoursSheet($attendance->routine_check_in,$attendance->routine_checkout)  }}--}}
{{--                                                        @php $routineTime += getTimeTotal($attendance->routine_check_in,$attendance->routine_checkout) @endphp--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ getWorkingHoursSheet($attendance->today_check_in,$attendance->today_check_out)  }}--}}
{{--                                                        @php $workingTime += getTimeTotal($attendance->today_check_in,$attendance->today_check_out) @endphp--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        @if($attendance->status == 1)--}}
{{--                                                            <span class="badge badge-success">Approve</span>--}}
{{--                                                        @else--}}
{{--                                                            <span class="badge badge-danger">Pending</span>--}}
{{--                                                        @endif--}}

{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        @php--}}

{{--                                                            $user = getUserDetail($attendance->update_by);--}}
{{--                                                            if($user){--}}
{{--                                                                echo ucfirst($user->name);--}}
{{--                                                            }--}}

{{--                                                        @endphp--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        @if((in_array('update-attendance', getUserPermissions())))--}}
{{--                                                            @if($attendance->status == 1)--}}
{{--                                                                <div class="btn-group" role="group"--}}
{{--                                                                     aria-label="Basic example">--}}
{{--                                                                    <a class="btn btn-primary"--}}
{{--                                                                       href="{{ route("edit.attendance", \Illuminate\Support\Facades\Crypt::encrypt($attendance->id))  }}"><em--}}
{{--                                                                            class="icon ni ni-edit"></em></a>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                @php $r_in =  $attendance->routine_check_in; @endphp--}}
{{--                                                @php $r_out = $attendance->routine_checkout; @endphp--}}

{{--                                                @php $t_in =  $attendance->today_check_in; @endphp--}}
{{--                                                @php $t_out = $attendance->today_check_out; @endphp--}}

                                                {{--@php $wh += getWorkingHours($r_in,$r_out); @endphp
                                                @php $th += getWorkingHours($t_in,$t_out); @endphp--}}

                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tbody>
                                        <td><b>Sum</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
{{--                                        <td>{{number_format($routineTime/60,2)}}</td>--}}
{{--                                        <td>{{number_format($workingTime/60,2)}}</td>--}}
                                        <td></td>
                                        <td></td>
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

@section('scripts')
    <script>
        $(document).ready(function () {
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
            endDate: '1d',
            startDate: '01-08-2021'
        });
        $('.bidder-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '1d',
            startDate: '01-08-2021'
        });
    </script>
@endsection
