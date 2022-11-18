<html lang="en">
<head>
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashlite.css?ver=2.2.0')}}" rel="stylesheet" type="text/css">
</head>
<style>
    table { width: 270px !important; font-size: 14px; font-family: Roboto, sans-serif, "Helvetica Neue", Arial, "Noto Sans", sans-serif }
    table tr td { padding: 4px 0px !important; border-top: 1px solid #333 !important; }
</style>
<body style="background: transparent !important;">

<a href="javascript:window.print()" class="btn btn-success waves-effect waves-light d-print-none"><em class="icon ni ni-printer-fill"></em> Print</a>
<a href="javascript:window.history.back()" class="btn btn-primary waves-effect waves-light d-print-none"><em class="icon ni ni-chevrons-left"></em> Back</a>

<div class="row" style="margin: 0px;">
    <div>
        <img class="" src="{{ asset(session()->get('system_settings.logo_header')) }}" style="max-width: 80px;">
    </div>
    <div class="table-responsive">
        <table class="table">
            <tbody>
            <tr>
                <td style="min-width: 90px;">Order #</td>
                <td>{{ $order['order_id'] }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{$order['name_title'] .' '.$order['first_name'] .' '. $order['last_name']}}</td>
            </tr>
            <tr>
                <td>Contact</td>
                <td>{{$order['mobile_number']}}</td>
            </tr>
            @if($order['alternate_number'])
            <tr>
                <td>Alternate Contact</td>
                <td>{{ $order['alternate_number'] }}</td>
            </tr>
            @endif
            <tr>
                <td>Email</td>
                <td>{{$order['email_address']}}</td>
            </tr>
            <tr>
                <td>Delivery Area</td>
                <td>{{$order['delivery_area_name']}}</td>
            </tr>
            @if($order['nearest_landmark'])
            <tr>
                <td>Nearest Landmark</td>
                <td>{{$order['nearest_landmark']}}</td>
            </tr>
            @endif
            <tr>
                <td>Address</td>
                <td>{{$order['delivery_address']}}</td>
            </tr>
            @if($order['delivery_instruction'])
            <tr>
                <td>Order Instructions</td>
                <td>{{$order['delivery_instruction']}}</td>
            </tr>
            @endif
            <tr>
                <td>Order Time</td>
                <td>{{$order['order_time']}}</td>
            </tr>
{{--            <tr>--}}
{{--                <td>Delivery Time</td>--}}
{{--                <td>{{$order['delivery_time']}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Delivery Type</td>--}}
{{--                <td>{{$order['delivery_type']}}</td>--}}
{{--            </tr>--}}

{{--            <tr>--}}
{{--                <td>Status</td>--}}
{{--                <td>{!!($order['order_status'] == 0) ? '<span class="badge badge-danger">Pending</span>' : '<span class="badge badge-success">Complete</span>'!!}</td>--}}
{{--            </tr>--}}

            <tr>
                <td colspan="2">
                    <table style="width: 280px !important;">
                        <tbody>
                        <tr>
                            <td style="width: 20px; border-top: none !important;"><b>#</b></td>
                            <td style="border-top: none !important;"><b>Product</b></td>
                            <td style="text-align: center; width: 40px; border-top: none !important;"><b>Qty</b></td>
                            <td style="text-align: right; width: 60px; border-top: none !important;"><b>Subtotal</b></td>
                        </tr>
                        @if($order['order_line_item'])
                            @php
                                $count = 1;
                            @endphp
                            @foreach($order['order_line_item'] as $order_line_items)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>
                                        <ul style="list-style: decimal;padding: 0px 0px 0px 15px;">
                                            <li>{{ $order_line_items['product_name'] }} - {{ $order_line_items['product_qty'] }} x {{ $order_line_items['product_price'] }}<br/></li>
                                            @if($order_line_items['order_line_item_option'])
                                                @php $subItemTotal = 0 @endphp
                                                {{--                                                                            @if($order_line_items['order_line_item_option'])--}}
                                                <ul style="list-style: disc;padding: 0px 0px 0px 15px;">
                                                    @php $itemTotal = 0 @endphp
                                                    @foreach($order_line_items['order_line_item_option'] as $order_line_item)
                                                        <li>{{ $order_line_item['option_type'] }} - {{ $order_line_item['option_name'] }} - {{ $order_line_items['product_qty'] }} x {{ $order_line_item['option_price'] }}<br/></li>
                                                        @php $itemTotal += $order_line_item['option_price'] @endphp
                                                    @endforeach
                                                    @php $subItemTotal =  ($order_line_items['product_qty'] * ($itemTotal + $order_line_items['product_price'])) @endphp
                                                </ul>
                                            @endif
                                        </ul>
                                        @if($order_line_items['product_special_instruction'])
                                            {{ $order_line_items['product_special_instruction'] }}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">{{ $order_line_items['product_qty'] }}</td>
                                    {{--                                                                    <td>Rs {{ $order_line_items['product_qty'] * ($itemTotal + $order_line_items['product_price']) }}</td>--}}
                                    <td style="text-align: right;">Rs {{ $subItemTotal }}</td>
                                </tr>
                                @php $count++ @endphp
                            @endforeach
                        @endif
                        </tbody>

                        <tfoot>
                        <tr>
                            <td></td>
                            <td colspan="2">Subtotal</td>
                            <td colspan="2" style="text-align: right;">Rs. {{ $order['subtotal'] }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2">GST</td>
                            <td colspan="2" style="text-align: right;">Rs. {{ $order['tax_amount'] }}</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2">Delivery Charges</td>
                            <td colspan="2" style="text-align: right;">Rs. {{ $order['delivery_amount'] }}</td>
                        </tr>


                        <tr>
                            <td></td>
                            <td colspan="2">Coupon </td>
                            <td colspan="2" style="text-align: right;">- Rs. 0</td>
                        </tr>

                        <tr>
                            <td></td>
                            <td colspan="2"><b>Total</b></td>
                            <td colspan="2" style="text-align: right;"><b>Rs. {{ $order['total'] }}</b></td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td colspan="5" style="text-align: center; font-size: 12px;">Powered By: Rehman Technologies</td>--}}
{{--                        </tr>--}}
                        </tfoot>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div style="page-break-after: always;"></div>
</body>
</html>
