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
    .rating:not(:checked) > label:hover ~ label { color: #FFA200;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFA200;  } 
    
    .search-sec {
    float: unset !important;
}


.modal-body {
    padding: 0rem 1.5rem !important;
}

.modal-content {
    padding: 10px;
}

label.form-label {
    color: #414042;
}

h5.modal-title {
    font-weight: 500;
}


.ggs .card-inner {
    padding: 20px 60px 20px 20px !important;
}
 
.ggs .card{
    border-radius: 10px !important;
}


.search-sec form.form-validate {
    margin-bottom: 0px;
    padding-bottom: 20px;
}

.search-sec .row.align-items-end.search-colll {
    margin-top: 20px !important; 
} 

span.day-colss {
    color: #A2A2A2;
}

#myModalEdit .modal-body {
    padding: 0px 0px 0px 0px !important;
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
    flex-flow: column !important;
}
}


.card-inner.sale-tables {
    padding: 0px !important;
}

.sale-tables .datatable-wrap {
    margin-left: 0 !important;
    margin-right: 0 !important;
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


.search-colll .search-coldd {
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

th.fixed-side.project-title {
    padding: 29px 20px;
}

td.fixed-side {
      padding: 2px 0px;
      line-height: 54px;
}

.row.align-items-end .btn-primary {
    margin-left: 20px;
    margin-bottom: 1px;
}


.row.align-items-end.search-colll {
    justify-content: center;
    margin-left: 0px !important;
}


.row.align-items-end.search-colll {
    margin-right: 15px !important;
}


.table-set th {
    border-bottom: 0px !important;
}

#table-scroll {
    border-radius: 20px !important;
}

.dark-mode .card.card-preview.search-sec {
    background: #59595A;
}


.datatable-wrap.my-3 {
    margin-top: 0px !important;
}


.dark-mode .select2-selection__placeholder:before {content: "Select Option";color: #f3f3f3;}


.select2-selection__placeholder:before {content: "Select Option";color:#414042;}


.dark-mode .sale-tables .datatable-wrap {
    background: unset;
    padding-top: 1px !important;
}

.card.card-preview .row.justify-between.g-2 {
    padding: 20px 0px;
}

.dark-mode .sale-tables .datatable-wrap {
    padding-top:0px !important;
}



.sale-tables  th {
    padding-top: 20px !important;
}

 .sale-tables .datatable-wrap {
    padding-top: 0px !important;
}

.card.card-preview .row.justify-between.g-2 {
    padding: 20px 0px !important;
}

span.select2-selection.select2-selection--single {
    width: 100% !important;
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
  bottom: 25px;
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
                            <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">  {{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item active"> {{ $section->title }}</li>
                                    </ul>
                                </nav>
                                    
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                             
                            </div><!-- .nk-block-head-content -->

                        </div><!-- .nk-block-between -->
                    </div>

                    <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                    <div class="components-preview">
     

<div class ="main-sets">
    <div class =" light-backbg  "> 
    <div class="nk-block  nk-block-lg ">
                        <div class="col-lg-12 ">
                            <div class="row g-gs">
                            <!-- <div class=""> </div>       -->
                                <div class="ggs col-md-2">
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
                                <div class="ggs col-md-2">
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
                                <div class="ggs col-md-2">
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
                                <div class="ggs col-md-2">
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
                                <div class="ggs col-md-2">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="card-title-group align-start mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Release Amount</h6>
                                                </div>
                                            </div>

                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                <div class="nk-sale-data"><span class="amount">$ {{ $getreleaseamount }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>       

                        <div class="nk-block  nk-block-lg">
                            <div class="card card-preview search-sec">
                            <div class="card-inner">
                            {!! Form::model($targets, ['method' => $section->method, 'route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                                <div class="row align-items-end search-colll ">

                                    @if((auth()->user()->user_type != 5) && (auth()->user()->user_type != 4))                                          

                                    <div class="search-coldd col-md-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap bid-select">
                                                {!! Form::select('name', $biddersUsers, $name, ['class' => 'form-control form-select select2', 'placeholder' => 'All Bidders']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-coldd col-md-3">
                                        <div class="form-group">
                                            <div class="form-control-wrap profile-select">
                                                {!! Form::select('profile_link', $profile, $profile_link, ['class' => 'form-control form-select select2', 'placeholder' => 'Select Profile']); !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="search-coldd col-md-5">
                                     <div class="form-group">
                                        <div class="form-control-wrap" style =" padding-right: 15px;">
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
                   
                    </div>
                  


{{--                    <div class="nk-block  nk-block-lg remov-pdd">--}}
{{--                        <div class="card card-preview  ">--}}
{{--                            <div class="card-inner">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <div id="table-scroll" class="table-scroll">--}}
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
                            <div class="card card-preview table-set">
                                <div class="card-inner">
                                    <div class="table-responsive">
                                        <div id="table-scroll" class="table-scroll">
                                            <div class="table-wrap">
                                                <table class="table-bordered  table-condensed   table table-hover  main-table  ">
                                                    <tr class ="main-tabblss">
                                                        <!-- <tr> -->
                                                        <th class="fixed-side project-title" > Name &nbsp; <i class="fas fa-arrow-down"></i>  </th>
                                                        @foreach($timePeriod as $key => $value)
                                                            <th style="text-align: left;"> {{ $value->format('d-M') }}<br/> <span class ="day-colss"> {{ $value->format('D') }} </span> </th>
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
                                <div class="card-inner sale-tables"  style ="padding: 0px !important;">

                                    <table class="datatable-init nowrap table">
                                        <thead>
                                        <tr>
                                            <th>ID   &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Links</th>
                                            <th>Chat Status  &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Sale Status &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <!-- <th>Date</th> -->
                                            <th>Timestamp &nbsp; <i class="fas fa-arrow-down"></i> </th>
                                            <th>Bidder &nbsp; <i class="fas fa-arrow-down"></i></th>
                                            <th>Profile  &nbsp; <i class="fas fa-arrow-down"></i></th>
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
                                                    <td class ="link-limit">{{$target->bid_link}}</td>
                                                    <td>{!!($target->is_chat == 0) ? '<span class="badge disable-check"><i class="fas fa-minus-circle"></i> &nbsp; Inactive </span> ' : '<span class="badge check-circle"> <i class="fas fa-check-circle">  </i> </span>'!!} {!! $target->is_chat == 1 ? $target->customer_name : ""  !!} </td>
                                                    <td>{!!($target->is_sale == 0) ? '<span class="badge disable-check"><i class="fas fa-minus-circle"></i>  &nbsp; Inactive </span> ' : '<span class="badge check-circle"> <i class="fas fa-check-circle"></i> </span> Active '!!}</td>
                                                    <!-- <td>{{ \Carbon\Carbon::parse($target->bid_date)->format('Y-M-d') }}</td> -->
                                                    <td>{{ \Carbon\Carbon::parse($target->created_at)->format('Y-M-d h:s:i a') }}</td>
                                                    <td>{{ $target->user->name ?? "" }}</td>
                                                    <td>{{ $target->profile->name }}</td>
                                                    <td>{!! ($target->is_request == 1) ? "<span class='badge badge-danger'>Pending</span>" : "" !!}</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            @if($target->rating == 5)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == "4 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == 4)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == "3 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == 3)
                                                           <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                           <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                           <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == "2 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == 2)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == "1 and a half")
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
                                                            <i class="fas fa-star-half-alt" style="color:#FFC560;"></i>
                                                            @elseif($target->rating == 1)
                                                            <i class="fas fa-star" aria-hidden="true" style="color:#FFC560;"></i>
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
                                                                        <a title="Edit" class="btn " onclick="edittarget({{$target->id}})">  <img class ="edits-btn"  style ="max-width: fit-content;" src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a>
                                                                    </div>
                                                               @endif
                                                           @else
                                                           @if((in_array(auth()->user()->user_type, [1,3,4,6])))
                                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                                    <a title="Edit" class="btn " onclick="edittarget({{$target->id}})">  <img class ="edits-btn"  style ="max-width: fit-content;"  src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a>
                                                                </div>
                                                            @endif
                                                           @endif



{{--                                                           @if(($target->is_request != 1) && (in_array(auth()->user()->user_type, [1,3])))--}}
{{--                                                            <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                                <a title="Edit" class="btn " href='{{ route("daily_target.edit",  \Illuminate\Support\Facades\Crypt::encrypt($target->id)) }}'>  <img class ="edits-btn"  style ="max-width: fit-content;"  src="{{asset('assets/images/svg/ico-edit.svg')}}" ></a>--}}
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
                                                            <a title="Edit" class="btn" onclick="addfeedback('{{$target->id}}~{{$target->feedback}}')"> <img class ="edits-btn"  style ="max-width: fit-content;"  src="{{asset('assets/images/svg/ico-edit.svg')}}" > </a>
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
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
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary  waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
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
   function addfeedback($id){
    var idandfeedback = $id.split("~");
        $('#myModalFeedback').modal('toggle');
        var id = idandfeedback[0];
        var feedback = idandfeedback[1];
        $("#hdnid").val( id );
        $("#feedback").val( feedback );
    }
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
