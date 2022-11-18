@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm  d-print-none">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route("order.index") }}">{{ $section->heading }}</a></li>
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
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="invoice-title">
                                                    <span class="float-right d-print-none">
                                                         <a href="{{ route('downloadInvoice',$order['order_id']) }} " class="btn btn-info"><em class="icon ni ni-printer-fill"></em>Print Invoice</a><br/><br/>
                                                    </span>
                                                    <h3 class="mt-0">
                                                        <h4>Order ID # {{ $order['order_id'] }} </h4>
                                                        <img src="{{ asset($order['brand']['picture']) }}" alt="{{ $order['brand']['name'] }}" width="200px" />
                                                    </h3>
                                                </div>
                                                <hr>
                                                <div class="row m-t-30">
                                                    <div class="col-6">
                                                        <address>
                                                            <strong>Customer Detail:</strong><br>
                                                            <strong>First Name:</strong> {{ $order['first_name'] }}<br>
                                                            <strong>Last Name:</strong> {{ $order['last_name'] }}<br>
                                                            <strong>Email:</strong> {{ $order['customer_email'] }}<br>
                                                            <strong>Phone Number:</strong> {{ $order['phone_number'] }}<br>
                                                            <strong>Address:</strong> {{ $order['address'] }}<br>
                                                            <strong>City:</strong> {{ $order['city'] }}<br>
                                                            <strong>Country:</strong> {{ $order['country'] }}<br>
                                                            <strong>State:</strong> {{ $order['state'] }}<br>
                                                            <strong>Zip Code:</strong> {{ $order['zip_code'] }}<br>
                                                        </address>
                                                    </div>
                                                    <div class="col-6">
                                                        <address>
                                                            <strong>Payment Status:</strong>
                                                         @if($order['payment_status'] == 1)
                                                            <span class="badge badge-success">Complete</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif<br>
                                                            <strong>Bank Name:</strong> {{ $order['bank_name'] }}<br>
                                                            <strong>Card Type:</strong> {{ $order['card_type'] }}<br>
                                                            <strong>Card Name:</strong> {{ $order['card_name'] }}<br>
                                                            <strong>Transection Type:</strong> {{ $order['transection_type'] }}<br>
                                                        </address>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div>
                                                    <div class="">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead>
                                                                <tr>
                                                                    <td><strong>Services</strong></td>
                                                                    <td><strong>Order Detail</strong></td>
                                                                    <td class="text-right"><strong>Amount</strong></td>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        @foreach ($order['order_line_item'] as $service)
                                                                            {{ $service['service_name'] }}
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $order['description'] }}</td>
                                                                    <td class="text-right">{{ $order['currency'] }} {{ $order['amount'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="no-line"></td>
                                                                    <td class="no-line text-right">
                                                                        <strong>Total</strong></td>
                                                                    <td class="no-line text-right"><h4 class="m-0">{{ $order['currency'] }} {{ $order['amount'] }}</h4></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
                </div>
            </div>
        </div>
    </div>
@endsection
