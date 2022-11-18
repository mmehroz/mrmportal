@extends('layouts.dashboard')

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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
    .table-covrr th {
    text-align: left !important;
    color: #000;
    font-weight: 500 !important;
}


.dark-mode .table-covrr th {
    color: #fff;
}

.table-covrr span.day-colss {
    color: #A2A2A2;
}

.filter-data th.sorting_disabled {
    line-height: 54px;
}
 
.filter-data .sale-tables .datatable-wrap {
    margin-left: 0px;
    margin-right: 0px;
}

.form-control-wrap.italic-input {
    color: #6B7582;
    margin-top:10px
}
.modal-title{
    font-weight:500 !important;
}


input.form-control.bidder-datepicker {color: #414042;font-weight: 500;}

em.icon.ni.ni-calendar {
    color: #414042;
    font-size: 20px;
}



div#myModal   .form-label {
    color: #414042;
}

div#myModal  .modal-body {
    padding-top: 0px;
}

div#myModal   .modal-content {
    padding: 20px 15px 20px 10px;
}

div#myModalBidPurchase .form-label {
    color: #414042;
}

div#myModalBidPurchase  .modal-body {
    padding-top: 0px;
}

div#myModalBidPurchase .form-label {
    color: #414042;
}

div#myModalBidPurchase .modal-content {
    padding: 20px 15px 20px 10px;
}

.backghk .card-inner {
    padding: 20px 60px 20px 20px !important;
}
 
.ggs .card{
    border-radius: 10px !important;
}

.search-sec-gg form.form-validate {
    margin-bottom: 20px !important;
}

.card.card-preview.search-sec-gg {
    padding-top: 20px !important;
}

span.day-colss {
    color: #A2A2A2;
}

.card-inner.sale-tables {
    padding-left: 0px !important;
    padding-right: 0px !important;
}



@media only screen and (max-width:1200px) {
.row.g-gs.backghk {flex-wrap: wrap !important;justify-content: flex-start !important;}
.ggs.left-box-bid {
    position: unset !important;
}
}




@media only screen and (max-width:1400px) {
    .backghk .card-inner {
    padding: 20px 20px 20px 20px !important;
}

}


@media only screen and (max-width:1650px) {
.colsdiv {
    width: 12% !important;
}


.left-box-bid {
    position: unset !important;
    left: 0px !important;
    width: 300px !important;
}

.left-box-bid .card-inner {
    padding-right: 0px !important;
}
}



@media only screen and (max-width:600px) {
.row.align-items-end {
    display: block;
}

.form-group {
    width: 100%;
}

span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

.form-group {
    margin: 20px 0px;
}

button.btn.btn-primary {
    margin-top: 15px;
}



.nk-block-between {
    display: block;
}

.meh_parent {
    margin-bottom: 35px;
    margin-top: 15px;
}

.breadcrumb {
    margin-bottom: 4px;
}



.nk-block-between {
    display: block !important;
}

.meh_parent {
    margin-bottom: 35px !important;
    margin-top: 15px !important;
    text-align: center !important;
    width: 100% !important;
    position: relative !important;
}

.breadcrumb {
    margin-bottom: 4px !important;
}

.nk-block-head-content {
    text-align: center !important;
}

ul.breadcrumb {justify-content: center !important; }


.light-backbg .row.g-gs {
    flex-flow: column !important;}


.colsdiv {
    display: none;
}

.meh_parent {
    justify-content: center !important;
}

}

span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

.search-coldd.col-md-1 {
    margin-right: 0px !important;
}

.row.align-items-end {
    margin: 0px !important;
}


.search-sec-gg .search-coldd {
    margin-right: 0px !important;
}



.row.align-items-end .btn-primary {
    position: relative !important;
    right: 20px !important;
    width: 100% !important;
}

.row.align-items-end {
    margin-left: 5px !important;
}


.row.align-items-end .btn-primary {
    margin-left: 20px;
    margin-bottom: 1px;
}


.card.card-preview.search-sec-gg {
    padding-right: 0px !important;
}


.search-sec-gg .row.align-items-end {
    flex-flow: inherit;
    padding: 0px 2px 0px 0px !important;
} 


.search-sec-gg .row.align-items-end {margin-right: 20px !important;justify-content: center !important;}

.light-backbg .table-responsive {
    border-radius: 20px !important;
    margin-bottom: 0px !important;
}




.dark-mode .card.card-preview.search-sec {
    background: #59595A;
}

.datatable-wrap.my-3 {
    margin-top: 0px !important;
}



.dark-mode  .bid-select  .select2-selection__placeholder:before {content: "All Bidders";color: #f3f3f3;} 

.dark-mode  .profile-select  .select2-selection__placeholder:before {content: "Select Profile";color: #f3f3f3;}

.bid-select .select2-selection__placeholder:before {content: "All Bidders";color:#414042;}

.profile-select  .select2-selection__placeholder:before {content: "Select Profile";color:#414042;}

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

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">  {{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                <h2 class="nk-block-title fw-normal"> {{ $section->title }}</h2>
                            </div><!-- .nk-block-head-content -->
                         @if((in_array('create-daily-target', getUserPermissions())))
                            <div class="meh_parent" style="display:flex">
                            <div class="nk-block-head-content" style="margin-right:20px">
{{--                                <a href="{{ route("daily_target.create") }}" class="btn btn-primary">Add New {{ $section->heading }}</a>--}}
                                <a data-toggle="modal" data-target="#myModal" class="btn btn-primary newbid-btn " style="color: #fff;">Add New {{ $section->heading }}</a>
                            </div>
                            <div class="nk-block-head-content">
                                <a data-toggle="modal" data-target="#myModalBidPurchase" class="btn btn-primary newbid-btn" style="color: #fff;">Bid Purchase</a>
                            </div>
                            </div>
                            @endif
                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview">

   <div class =" light-backbg  backffff">
                    
                    <div class="nk-block  nk-block-lg backggjg">
                            <div class="col-lg-12 ">
                                <div class="row g-gs backghk">
                                    <div class="ggs col">
                                        <div class="card card-bordered unit-bidd-color" >
                                            <div class="card-inner" style="padding-right: 0px !important;">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Daily Bidding Target</h6>
                                                    </div>
                                                </div>
                                                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                    <div class="nk-sale-data data-amount"><span class="amount"> All Bidders </span></div>
                                                    <div class="label alert-primary">

                                                        @if($targets->count() > 0)
                                                            <strong>COR</strong>. {{ round( ($targets->sum('is_chat') * 100) / $targets->count(), 2)  }} %
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="colsdiv"> </div> -->

                                    <div class="ggs col">
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
                                    <div class="ggs col">
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
                                    <div class="ggs col">
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
                                    <div class="ggs col">
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
                            <div class="card card-preview search-sec-gg">
                            <div class="card-inner">
                            {!! Form::model($targets, ['method' => $section->method, 'route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                                <div class="row align-items-end">
                                    @if((auth()->user()->user_type != 5) && (auth()->user()->user_type != 4))
                                    <div class="search-coldd  col-md-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap  bid-select">
                                                {!! Form::select('name', $biddersUsers, $name, ['class' => 'form-control form-select select2', 'placeholder' => 'All Bidders']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-coldd  col-md-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap profile-select">
                                                {!! Form::select('profile_link', $profile, $profile_link, ['class' => 'form-control form-select select2', 'placeholder' => 'Select Profile']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="search-coldd  col-md-5">
                                     <div class="form-group">
                                       
                                        <div class="form-control-wrap" >
                                        <div class="input-daterange date-picker-range input-group">
                                         {!! Form::text('date_from', $date_from, ['class' => 'form-control target-datepicker', 'placeholder' => 'Enter From Date']) !!}
                                            <div class="input-group-addon">TO</div>
                                         {!! Form::text('date_to', $date_to, ['class' => 'form-control target-datepicker', 'placeholder' => 'Enter To Date']) !!}
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="search-coldd col-md-1.4">
                                     {!! Form::button('<i class="fa fa-check-square-o"></i> Search', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                       

                        <div class="nk-block  nk-block-lg range-sec ">
                            <div class="card card-preview ">
                                <div class="card-inner">
                                    <div class="table-responsive" style ="margin-bottom: 0px !important;">
                                        <div id="table-scroll" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table-bordered  table-condensed   table table-hover  main-table table-covrr ">
                                                    <tr class ="main-tabblss">
                                                        <th class="fixed-side project-title" > Name  &nbsp; <i class="fas fa-arrow-down"></i> <br/> &nbsp;  </th>
                                                        @foreach($timePeriod as $key => $value)
                                                        <th style="text-align: center;"> {{ $value->format('d-M') }}<br/> <span class ="day-colss"> {{ $value->format('D') }}</span> </th>
                                                        @endforeach
                                                    </tr>
                                                    @foreach($targets->groupBy(['user_id', 'bid_date'])->toArray() as $key => $bidderDates)
                                                    <tr class ="tble-data">
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
</div>

                  <div class="nk-block nk-block-lg">
                            <div class="card card-preview ">
                                <div class="card-inner filter-data">

                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID  &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Links</th>
                                            <th>Chat Status  &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Sale Status &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <!-- <th>Date</th> -->
                                            <th>Timestamp &nbsp; <i class="fas fa-arrow-down"></i> </th>
                                            <th>Bidder &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Profile  &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $targets )
                                            @foreach( $targets as $target )
                                                <tr id="rowID-{{ $target->id }}">
                                                    <td>{{ $target->id }}</td>
                                                    <td class ="link-limit">{{$target->bid_link}}</td>
                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge disable-check"> <i class="fas fa-minus-circle"></i>   &nbsp; Inactive</span>' : '<span class="badge  check-circle">  <i class="fas fa-check-circle">  </i> </span>'!!} {!! $target->is_chat == 1 ? $target->customer_name : ""  !!} </td>
                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge disable-check"> <i class="fas fa-minus-circle"> </i>  &nbsp; Inactive </span>' : '<span class="badge check-circle"> <i class="fas fa-check-circle">   </i> </span>  Active '!!}</td>
                                                    <!-- <td>{{ \Carbon\Carbon::parse($target->bid_date)->format('Y-M-d') }}</td> -->
                                                    <td>{{ \Carbon\Carbon::parse($target->created_at)->format('Y-M-d h:s:i a') }}</td>
                                                    <td>{{ $target->user->name ?? "" }}</td>
                                                    <td>{{ $target->profile->name }}</td>
                                                    <td>{!! ($target->is_request == 1) ? ' <i class="fas fa-minus-circle pending-ico"></i>&nbsp; Pending' : '' !!}</td>
                                                    <td>
                                                       @if((in_array('update-daily-target', getUserPermissions())))
                                                           @if($target->is_request == 1)
                                                               @if((in_array(auth()->user()->user_type, [1,3,6])))
                                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                                        <a title="Edit" class="btn " onclick="edittarget({{$target->id}})"><img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a>
                                                                    </div>
                                                               @endif
                                                           @else
                                                           @if((in_array(auth()->user()->user_type, [1,3,4,6])))
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a title="Edit" class="btn " onclick="edittarget({{$target->id}})"><img class ="edits-btn"  src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a>
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
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
                                <div class="form-control-wrap italic-input">
                                    <input type="hidden" class ="italic-input" name="buyer_name" value="{{ ucfirst(auth()->user()->name) }}">
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div id ='modals'></div>
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
   function edittarget($id){
    $('.row.justify-between.g-2').remove();
    $('.row.align-items-center').remove();
    $('.select2.select2-container.select2-container--default').remove();
      $.get('{{ URL::to("edittarget")}}/'+$id,function(data){
      $('#modals').empty().append(data);
      $('#myModalEdit').modal('show');
      });
    }
</script>
@endsection
