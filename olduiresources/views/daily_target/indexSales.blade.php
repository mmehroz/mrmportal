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
    fieldset, label { margin: 0; padding: 0; }
    body{ margin: 20px; }
    h1 { font-size: 1.5em; margin: 10px; }

    /****** Style Star Rating Widget *****/

    .rating { 
      border: none;
      float: left;
    }

    .rating > input { display: none; } 
    .rating > label:before { 
      margin: 5px;
      font-size: 1.25em;
      font-family: FontAwesome;
      display: inline-block;
      content: "\f005";
    }

    .rating > .half:before { 
      content: "\f089";
      position: absolute;
    }

    .rating > label { 
      color: #ddd; 
     float: right; 
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
    
</style>
<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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

                    <div class="components-preview">
                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview">
                            <div class="card-inner">
                            {!! Form::model($targets, ['method' => $section->method, 'route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                                <div class="row align-items-end">
                                    @if((auth()->user()->user_type != 5) && (auth()->user()->user_type != 4))
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-topics">Bidder</label>
                                            <div class="form-control-wrap ">
                                                {!! Form::select('name', $biddersUsers, $name, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="fv-topics">Profile</label>
                                            <div class="form-control-wrap ">
                                                {!! Form::select('profile_link', $profile, $profile_link, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a option']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
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
                                    <div class="col-md-2">
                                     {!! Form::button('<i class="fa fa-check-square-o"></i> Search', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="nk-block  nk-block-lg">
                        <div class="col-lg-12 ">
                            <div class="row g-gs">
                                <div class="col-sm-3">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Leads</h6>
                                                </div>
                                            </div>
                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                <div class="nk-sale-data"><span class="amount">{{ $totalSalePersonId }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Sale Lock</h6>
                                                </div>
                                            </div>
                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                <div class="nk-sale-data"><span class="amount">{{ $targets->sum('is_sale') }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Conversion Ratio</h6>
                                                </div>
                                            </div>
                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                <div class="nk-sale-data">
                                                    <span class="amount">
                                                        @if($targets->sum('is_sale') > 0)
                                                        {{ round( ($targets->sum('is_sale') * 100) / $totalSalePersonId, 2)  }} %
                                                        @endif
                                                    </span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Total Amount</h6>
                                                </div>
                                            </div>

                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                <div class="nk-sale-data"><span class="amount">$ {{ $totalSumAmount }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


{{--                    <div class="nk-block  nk-block-lg">--}}
{{--                        <div class="card card-preview">--}}
{{--                            <div class="card-inner">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <div id="table-scroll1" class="table-scroll">--}}
{{--                                        <div class="table-wrap">--}}
{{--                                            <table class="table-bordered  table-condensed   table table-hover  main-table  ">--}}
{{--                                                <tr>--}}
{{--                                                    <th class="fixed-side project-title" > Name <br/> &nbsp;  </th>--}}
{{--                                                    @foreach($timePeriod as $key => $value)--}}
{{--                                                    <th style="text-align: center;"> {{ $value->format('d-M') }}<br/> {{ $value->format('D') }}</th>--}}
{{--                                                    @endforeach--}}
{{--                                                </tr>--}}
{{--                                                @foreach($targets->groupBy(['user_id', 'bid_date'])->toArray() as $key => $bidderDates)--}}
{{--                                                <tr>--}}
{{--                                                    <td class="fixed-side"> {{ getUserDetail($key)->name ?? "" }} </td>--}}
{{--                                                    @foreach($timePeriod as $timePeriodkey => $dateNormal)--}}
{{--                                                        <td>--}}
{{--                                                        @foreach($bidderDates as $bidderKey => $bidderDate)--}}
{{--                                                                @if($dateNormal->format('Y-m-d') == $bidderKey)--}}
{{--                                                                    <a href="{{ route('daily_target.dayReport',  [$key, $bidderKey]) }}">{{ count($bidderDate) }}</a>--}}
{{--                                                                    @continue--}}
{{--                                                                @else--}}
{{--                                                                        {{ $dateNormal->format('Y-m-d') }}--}}
{{--                                                                @endif--}}
{{--                                                        @endforeach--}}
{{--                                                        </td>--}}
{{--                                                    @endforeach--}}
{{--                                                </tr>--}}
{{--                                                @endforeach--}}
{{--                                            </table>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="table-responsive">
                                        <div id="table-scroll2" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table-bordered  table-condensed   table table-hover  main-table  ">
                                                    <tr>
                                                        <th class="fixed-side project-title" > Name <br/> &nbsp;  </th>
                                                        @foreach($timePeriod as $key => $value)
                                                            <th style="text-align: center;"> {{ $value->format('d-M') }}<br/> {{ $value->format('D') }}</th>
                                                        @endforeach
                                                    </tr>

                                                    @foreach($targets->groupBy(['sale_person_id', 'is_chat_date'])->toArray() as $key => $bidderDates)
                                                        @if($key > 0)
                                                        <tr>
                                                            <td class="fixed-side"> {{ getUserDetail($key)->name ?? "" }} </td>
                                                            @foreach($timePeriod as $timePeriodkey => $dateNormal)
                                                                <td>
                                                                    @foreach($bidderDates as $bidderKey => $bidderDate)
                                                                        @if($dateNormal->format('Y-m-d') == $bidderKey)
                                                                            <a href="{{ route('daily_target.salesDayReport',  [$key, $bidderKey]) }}">{{ count($bidderDate) }}</a>
                                                                            @continue
                                                                        @else
                                                                            {{--                                                                        {{ $dateNormal->format('Y-m-d') }}--}}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="nk-block nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">

                                    <table class="datatable-init nowrap table">

                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Link</th>
                                            <th>Is Chat Opened ?</th>
                                            <th>Is Sale Opened ?</th>
                                            <!-- <th>Date</th> -->
                                            <th>Bid Timestamp</th>
                                            <th>Bidder</th>
                                            <th>Profile</th>
                                            <th>Status</th>
                                            <th>Review</th>
                                            <th>Action</th>
                                            @if((auth()->user()->user_type == 3 || auth()->user()->user_type == 6))
                                            <th>Feedback</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $targets )
                                            @foreach( $targets as $target )
                                                <tr id="rowID-{{ $target->id }}">
                                                    <td>{{ $target->id }}</td>
                                                    <td>{{$target->bid_link}}</td>
                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!} {!! $target->is_chat == 1 ? $target->customer_name : ""  !!} </td>
                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>
                                                    <!-- <td>{{ \Carbon\Carbon::parse($target->bid_date)->format('Y-M-d') }}</td> -->
                                                    <td>{{ \Carbon\Carbon::parse($target->created_at)->format('Y-M-d h:s:i a') }}</td>
                                                    <td>{{ $target->user->name ?? "" }}</td>
                                                    <td>{{ $target->profile->name }}</td>
                                                    <td>{!! ($target->is_request == 1) ? "<span class='badge badge-danger'>Pending</span>" : "" !!}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            @if($target->rating == 5)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            @elseif($target->rating == "4 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:yellow;"></i>
                                                            @elseif($target->rating == 4)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            @elseif($target->rating == "3 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:yellow;"></i>
                                                            @elseif($target->rating == 3)
                                                           <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                           <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                           <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            @elseif($target->rating == "2 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:yellow;"></i>
                                                            @elseif($target->rating == 2)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            @elseif($target->rating == "1 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:yellow;"></i>
                                                            @elseif($target->rating == 1)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:yellow;"></i>
                                                            @elseif($target->rating == "half")
                                                           
                                                            @else
                                                         
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                       @if((in_array('update-daily-target', getUserPermissions())))
                                                           @if($target->is_request == 1)
                                                               @if((in_array(auth()->user()->user_type, [1,3,6])))
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>
                                                                    </div>
                                                               @endif
                                                           @else
                                                           @if((in_array(auth()->user()->user_type, [1,3,4,6])))
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>
                                                                </div>
                                                            @endif
                                                           @endif



{{--                                                           @if(($target->is_request != 1) && (in_array(auth()->user()->user_type, [1,3])))--}}
{{--                                                            <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                                <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>--}}
{{--                                                            </div>--}}
{{--                                                            @endif--}}
                                                       @endif
                                                    </td>
                                                    @if((auth()->user()->user_type == 3 || auth()->user()->user_type == 6))
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            @if($target->feedback != null && auth()->user()->user_type == 6)
                                                            <span>Already Done</span>
                                                            @else
                                                            <a title="Edit" class="btn btn-primary" onclick="addfeedback('{{$target->id}}~{{$target->feedback}}')"><em class="icon ni ni-edit"></em></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- .card-preview -->
                        </div> <!-- nk-block -->


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
{{--                                            <th>Bid Timestamp</th>--}}
{{--                                            <th>Bidder</th>--}}
{{--                                            <th>Profile</th>--}}
{{--                                            <th>Status</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @if( $sales_targets )--}}
{{--                                            @foreach( $sales_targets as $target )--}}
{{--                                                <tr id="rowID-{{ $target->id }}">--}}
{{--                                                    <td>{{ $target->id }}</td>--}}
{{--                                                    <td>{{$target->bid_link}}</td>--}}
{{--                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!} {!! $target->is_chat == 1 ? $target->customer_name : ""  !!} </td>--}}
{{--                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge badge-danger">No</span>' : '<span class="badge badge-success">Yes</span>'!!}</td>--}}
{{--                                                    <td>{{ \Carbon\Carbon::parse($target->bid_date)->format('Y-M-d') }}</td>--}}
{{--                                                    <td>{{ \Carbon\Carbon::parse($target->created_at)->format('Y-M-d h:s:i a') }}</td>--}}
{{--                                                    <td>{{ $target->user->name ?? "" }}</td>--}}
{{--                                                    <td>{{ $target->profile->name }}</td>--}}
{{--                                                    <td>{!! ($target->is_request == 1) ? "<span class='badge badge-danger'>Pending</span>" : "" !!}</td>--}}
{{--                                                    <td>--}}
{{--                                                        @if((in_array('update-daily-target', getUserPermissions())))--}}
{{--                                                            @if($target->is_request == 1)--}}
{{--                                                                @if((in_array(auth()->user()->user_type, [1,3])))--}}
{{--                                                                    <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                                        <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>--}}
{{--                                                                    </div>--}}
{{--                                                                @endif--}}
{{--                                                            @else--}}
{{--                                                                <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                                    <a title="Edit" class="btn btn-primary" href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'><em class="icon ni ni-edit"></em></a>--}}
{{--                                                                </div>--}}
{{--                                                            @endif--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div><!-- .card-preview -->--}}
{{--                        </div> --}}
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
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('daily_target.store') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Bid Link (Fiverr/Upwork/Freelancer/Guru)</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('bid_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Link ', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-topics">Sales Profile</label>
                                <div class="form-control-wrap ">
                                    {!! Form::select('profile_link', $profile, 0, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="form-label" for="fv-topics">Is Chat Opened ?</label>--}}
{{--                                <div class="form-control-wrap ">--}}
{{--                                    {!! Form::select('is_chat', array(1 => 'Yes', 0 => 'No'), 0, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="form-label" for="fv-topics">Is Sale Opened ?</label>--}}
{{--                                <div class="form-control-wrap ">--}}
{{--                                    {!! Form::select('is_sale', array(1 => 'Yes', 0 => 'No'), 0, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Bid Amount <small>(in USD)</small></label>
                                <div class="form-control-wrap">
                                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Amount ', 'onkeypress' => 'return isDecimal(event)']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Bidding Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('bid_date', $date_to, ['class' => 'form-control  bidder-datepicker', 'placeholder' => 'Enter Bid Date ', 'required' => 'required']) !!}
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
    <!-- Feedback Modal -->
   <div id="myModalFeedback" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Feedback</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('daily_target.feedback') }}" autocomplete="off">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <input type="hidden" id="hdnid" name="hdnid" value="">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Rating</label>
                                <div class="form-control-wrap">
                                  <fieldset class="rating">
                                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                </fieldset>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Enter Feedback</label>
                                <div class="form-control-wrap">
                                    {!! Form::text('feedback', null, ['class' => 'form-control', 'id' => 'feedback', 'placeholder' => 'Enter Feedback', 'required' => 'required']) !!}
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
@endsection

@section('scripts')
<script>
   $(document).ready(function() {
        $('.select2').select2();
       // For stickey column
       $(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
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
   function addfeedback($id){
    var idandfeedback = $id.split("~");
        $('#myModalFeedback').modal('toggle');
        var id = idandfeedback[0];
        var feedback = idandfeedback[1];
        $("#hdnid").val( id );
        $("#feedback").val( feedback );
    }
</script>
@endsection
