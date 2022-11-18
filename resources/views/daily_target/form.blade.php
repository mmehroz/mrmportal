<style>
span.select2-selection.select2-selection--single {
    width: 100% !important;
}
</style>


@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">  {{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("daily_target.index") }}">{{ $section->heading }}</a>
                                        </li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                            </div>
                        </div><!-- .nk-block-head -->

                        <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    {!! Form::model($target, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data','autocomplete' => 'off']) !!}
                                    @method($section->method)
                                    <div class="row g-gs">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                @if(in_array(auth()->user()->user_type,[0,1,3]))
                                                    @if($target->is_request == 1)
                                                        <a data-toggle="modal" data-target="#myModal2"
                                                           title="View Previous Record" id="previousRecord"
                                                           class="btn btn-sm btn-danger float-right mb-1"
                                                           href='javascript:void(0)'><em
                                                                class="icon ni ni-eye-fill"></em></a>
                                                    @endif
                                                @endif
                                                <label class="form-label" for="fv-full-name">Bid Link
                                                    (Fiverr/Upwork/Freelancer/Guru)</label>
                                                <div class="form-control-wrap">
                                                    {!! Form::text('bid_link', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Link ', 'required' => 'required', ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Sales Profile</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('profile_link', $profile, null, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Is Chat Opened ?</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('is_chat', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', 'id' => 'chatOpen' ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Is Sale Opened ?</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('is_sale', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        @if($target->is_chat == 1)
                                            <div class="col-md-6 customer_name">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Customer Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 customer_name" >
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Sales Persons</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::select('sale_person_id', $sale_person_id, null, ['class' => 'form-control', 'placeholder' => 'Select a option']); !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-6 customer_name" style="display: none">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Customer Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('customer_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Customer Name', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 customer_name" style="display: none">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Sales Persons</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::select('sale_person_id', $sale_person_id, null, ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required']); !!}
                                                    </div>
                                                </div>
                                            </div>

                                        @endif

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Bid Amount <small>(in
                                                        USD)</small></label>
                                                <div class="form-control-wrap">
                                                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Bid Amount ', 'onkeypress' => 'return isDecimal(event)', ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Bidding Date</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('bid_date', null, ['class' => 'form-control  bidder-datepicker', 'placeholder' => 'Enter Bid Date ', 'required' => 'required', ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Feedback</label>
                                                @if(auth()->user()->user_type == 3)
                                                <input type="text" name="feedback" class="form-control" value="{{$target->feedback}}">
                                                @else
                                                <input type="text" name="feedback" readonly class="form-control" value="{{$target->feedback}}">
                                                @endif
                                            </div>
                                        </div>
                                        {{-- For Admin and Owner --}}
                                        @if(in_array(auth()->user()->user_type, [0,1,3]) || auth()->user()->isallow == 1)
                                            @php
                                                $status = $target->is_approved; // == 1 ? 1 : 0
                                            @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Status</label>
                                                    @if($status == 1)
                                                        <span class="badge badge-success">Approve</span>
                                                    @elseif($status == 2)
                                                        <span class="badge badge-warning">Reject</span>
                                                    @else
                                                        <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                    <div class="form-control-wrap ">
                                                        <div class="custom-control custom-control-lg custom-radio">
                                                            <input type="radio" id="Pending" name="status" value="0"
                                                                   class="custom-control-input" {!! ($status == 0) ? 'checked' : "" !!}>
                                                            <label class="custom-control-label"
                                                                   for="Pending">Pending</label>
                                                        </div>
                                                        <div class="custom-control custom-control-lg custom-radio">
                                                            <input type="radio" id="Approve" name="status" value="1"
                                                                   class="custom-control-input" {!! ($status == 1) ? 'checked' : "" !!}>
                                                            <label class="custom-control-label"
                                                                   for="Approve">Approve</label>
                                                        </div>
                                                        <div class="custom-control custom-control-lg custom-radio">
                                                            <input type="radio" id="Reject" name="status" value="2"
                                                                   class="custom-control-input" {!! ($status == 2) ? 'checked' : "" !!}>
                                                            <label class="custom-control-label"
                                                                   for="Reject">Reject</label>
                                                        </div>
                                                        {{--                                                        {!! Form::select('status',  array(0 => "Pending", 1 => "Approve", 2 => "Reject"),  $status, ['class' => 'form-control form-select', 'placeholder' => 'Select a option' ]); !!}--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::button('<i class="fa fa-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>

    @if($target->requested_data)
        @php
            $oldData = unserialize($target->requested_data);
        @endphp

        <!-- sample modal content -->
        <div id="myModal2" class="modal in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Previous Record</h5>
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <!-- Form with validation -->
                    <form id="users-frm" class="form-validate is-alter" method="POST" action="" autocomplete="off">
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-label" for="fv-full-name">Bid Link
                                        (Fiverr/Upwork/Freelancer/Guru)</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('bid_link', $oldData['bid_link'], ['class' => 'form-control', 'placeholder' => 'Enter Bid Link ', 'required' => 'required', 'disabled']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label" for="fv-topics">Is Chat Opened ?</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::select('is_chat', array(1 => 'Yes', 0 => 'No'), $oldData['is_chat'], ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required', 'disabled']); !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="fv-topics">Is Sale Opened ?</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::select('is_sale', array(1 => 'Yes', 0 => 'No'), $oldData['is_sale'], ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required', 'disabled']); !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-label" for="fv-topics">Customer Name</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::text('customer_name', (isset($oldData['customer_name'])) ? $oldData['customer_name'] : "", ['class' => 'form-control', 'placeholder' => 'Enter Customer Name', 'required' => 'required', 'disabled']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="form-label" for="fv-full-name">Bid Amount <small>(in
                                            USD)</small></label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('amount', $oldData['amount'], ['class' => 'form-control', 'placeholder' => 'Enter Bid Amount ', 'required' => 'required', 'onkeypress' => 'return isDecimal(event)','disabled']) !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="fv-full-name">Bidding Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em>
                                        </div>
                                        {!! Form::text('bid_date', $oldData['bid_date'] ? $oldData['bid_date'] : "", ['class' => 'form-control  bidder-datepicker', 'placeholder' => 'Enter Bid Date ', 'required' => 'required', 'disabled']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Sales Profile</label>
                                        <div class="form-control-wrap ">
                                            {!! Form::select('profile_link', $profile, $oldData['profile_link'], ['class' => 'form-control', 'placeholder' => 'Select a option', 'required' => 'required', 'disabled']); !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel
                            </button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endif
@endsection
@push('scripts')
    <script>
        {{--$( document ).ready(function() {--}}
        {{--    if(!empty("{{ $target->customer_name }}")){--}}
        {{--        $('.customer_name').show();--}}
        {{--    }--}}
        {{--});--}}


        $('.bidder-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '1d'
        });

        $('#chatOpen').on('change', function () {
            if (this.value == 1) {
                $('.customer_name').show();
            } else {
                $('.customer_name').hide();
            }
        });
    </script>
@endpush
