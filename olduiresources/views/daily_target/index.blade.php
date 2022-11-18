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
                         @if((in_array('create-daily-target', getUserPermissions())))
                            <div class="meh_parent" style="display:flex">
                            <div class="nk-block-head-content" style="margin-right:20px">
{{--                                <a href="{{ route("daily_target.create") }}" class="btn btn-primary">Add New {{ $section->heading }}</a>--}}
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary" style="color: #fff;">Add New {{ $section->heading }}</a>
                            </div>
                            <div class="nk-block-head-content">
                                <a data-toggle="modal" data-target="#myModalBidPurchase" class="btn btn-primary" style="color: #fff;">Bid Purchase</a>
                            </div>
                            </div>
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
                                    <div class="col-sm-2">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Daily Bidding Target</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $dailytarget }}</span></div>
                                                    <div class="label alert-primary">

                                                        @if($targets->count() > 0)
                                                            <strong>COR</strong>. {{ round( ($targets->sum('is_chat') * 100) / $targets->count(), 2)  }} %
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Connects Cost</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $getconnectspurchase }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Bids</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->count() }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Chat Open</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->sum('is_chat') }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Total Sale Open</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data"><span class="amount">{{ $targets->sum('is_sale') }}</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview">
                                <div class="card-inner">
                                    <div class="table-responsive">
                                        <div id="table-scroll1" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table-bordered  table-condensed   table table-hover  main-table  ">
                                                    <tr>
                                                        <th class="fixed-side project-title" > Name <br/> &nbsp;  </th>
                                                        @foreach($timePeriod as $key => $value)
                                                        <th style="text-align: center;"> {{ $value->format('d-M') }}<br/> {{ $value->format('D') }}</th>
                                                        @endforeach
                                                    </tr>
                                                    @foreach($targets->groupBy(['user_id', 'bid_date'])->toArray() as $key => $bidderDates)
                                                    <tr>
                                                        <td class="fixed-side"> {{ getUserDetail($key)->name ?? "" }} </td>
                                                        @foreach($timePeriod as $timePeriodkey => $dateNormal)
                                                            <td>
                                                            @foreach($bidderDates as $bidderKey => $bidderDate)
                                                                    @if($dateNormal->format('Y-m-d') == $bidderKey)
                                                                        <a href="{{ route('daily_target.dayReport',  [$key, $bidderKey]) }}">{{ count($bidderDate) }}</a>
                                                                        @continue
                                                                    @else
{{--                                                                        {{ $dateNormal->format('Y-m-d') }}--}}
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
                                            <th>Action</th>
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
 <!-- Bid Purchase modal content -->
    <div id="myModalBidPurchase" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Bid Purchase</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('daily_target.bidpurchase') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Enter Connects Purchase</label>
                                <div class="form-control-wrap">
                                    {!! Form::number('bid_purchaseamount', null, ['class' => 'form-control', 'placeholder' => 'Enter $ Amount', 'required' => 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Enter How Many Connects Purchased</label>
                                <div class="form-control-wrap">
                                    {!! Form::number('bid_purchasequantity', null, ['class' => 'form-control', 'placeholder' => 'Enter Quantity', 'required' => 'required']) !!}
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
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Buyer Name</label>
                                <div class="form-control-wrap">
                                    <input type="hidden" name="buyer_name" value="{{ ucfirst(auth()->user()->name) }}">
                                   {{ ucfirst(auth()->user()->name) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Purchase Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('bid_purchasedate', $date_to, ['class' => 'form-control  bidder-datepicker', 'readonly' => 'true', 'required' => 'required']) !!}
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
</script>
@endsection