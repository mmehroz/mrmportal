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
                            <div class="nk-block-head-content">
                                {!! Form::model($orders, ['route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                                @method('GET')
                                <label class="form-label" for="fv-topics">Select Date</label>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><em class="icon ni ni-calendar"></em></span>
                                        </div>
                                        {!! Form::text('order_date', $orderDate, ['class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd']) !!}
                                        <div class="input-group-append">
                                            {!! Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary waves-effect waves-light']) !!}
                                        </div>
                                    </div>

{{--                                        <div class="form-control-wrap">--}}
{{--                                            <div class="form-icon form-icon-left">--}}
{{--                                                <em class="icon ni ni-calendar"></em>--}}
{{--                                            </div>--}}
{{--                                            {!! Form::text('order_date', $orderDate, ['class' => 'form-control date-picker', 'data-date-format' => 'yyyy-mm-dd', 'required' => 'required']) !!}--}}
{{--                                        </div>--}}
{{--                                            {!! Form::button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary waves-effect waves-light']) !!}--}}

                                    </div>
                                {!! Form::close() !!}
                            </div><!-- .nk-block-head-content -->
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
                                            <th class="sorting_desc" aria-sort="descending">ID</th>
                                            <th data-order="1">Time</th>
                                            <th>Customer Email</th>
                                            <th>Amount</th>
                                            <th>Brand</th>
                                            <th>Service</th>
                                            <th>Sale Person</th>
                                            <th>Status</th>
                                            <th>Payment</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if( $orders )
                                            @foreach( $orders as $order )
                                                <tr id="rowID-{{ $order['id'] }}">
                                                    <td>{{ $order['id'] }}</td>
                                                    <td>{{$order['order_time']}}</td>
                                                    <td>{{$order['customer_email']}}</td>
                                                    <td>{{$order['currency']}} {{ number_format($order['amount'], 2, '.', ',') }}</td>
                                                    <td>{{getBrandName($order['brand_id']) }}</td>
                                                    <td>
                                                        @if($order['order_line_item'])
                                                            <ul style="list-style: decimal;">
                                                                @foreach($order['order_line_item'] as $order_line_items)
                                                                    <li><strong>{{ $order_line_items['service_name'] }} </strong></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </td>
                                                    <td>{{getUserDetail($order['sale_person'])->name }} <br/> {{ getUserDetail($order['sale_person'])->email }}</td>
                                                    <td>
                                                        @if($order['order_status'] == 1)
                                                            <span class="badge badge-dim badge-success">Complete</span>
                                                        @elseif($order['order_status'] == 2)
                                                            <span class="badge badge-dim badge-danger">Cancel</span>
                                                        @else
                                                            <span class="badge badge-dim badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>                                                      
                                                         @if($order['payment_status'] == 1)
                                                            <span class="badge badge-dim badge-success">Complete</span>
                                                        @else
                                                            <span class="badge badge-dim badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a class="btn btn-warning" href='{{ route("order.show", $order['id']) }}' data-toggle="tooltip" data-placement="top" title="View"><em class="icon ni ni-eye-fill"></em></a>
                                                     @if(auth()->user()->user_type != 2)
                                                             @if(in_array('update-order', getUserPermissions()))
                                                            <a class="btn btn-primary" href='{{ route("order.edit", $order['id']) }}' data-toggle="tooltip" data-placement="top" title="Edit"><em class="icon ni ni-edit-fill"></em></a>
                                                            @endif
                                                            <a class="btn btn-success" href="{{ route("order.paynow", \Illuminate\Support\Facades\Crypt::encrypt($order['id'])) }}" data-toggle="tooltip" data-placement="top" title="Payment Link"><em class="icon ni ni-link"></em></a>
                                                    @endif
                                                        </div>
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
@endsection

@push('scripts')
    <script>
        !function($) {
            "use strict";

            var AdvancedForm = function() {};

            AdvancedForm.prototype.init = function() {
                //creating various controls

                jQuery('#datepicker').datepicker();
                jQuery('.date-picker').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: "yyyy-mm-dd",
                    clearBtn: true,
                    endDate: new Date(),
                });
            },
                //init
                $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
        }(window.jQuery),

        //initializing
        function ($) {
            "use strict";
            $.AdvancedForm.init();
        }(window.jQuery);
    </script>
@endpush
