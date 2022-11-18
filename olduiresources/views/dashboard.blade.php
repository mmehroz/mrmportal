@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Sales Overview</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Welcome to MRM Sales Portal</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">

                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
{{--                    <div class="nk-block">--}}
{{--                        <div class="row g-gs">--}}
{{--                            <div class="col-xxl-6">--}}
{{--                                <div class="row g-gs">--}}
{{--                                    <div class="col-lg-6 col-xxl-6">--}}
{{--                                        <div class="card card-bordered">--}}
{{--                                            <div class="card-inner">--}}
{{--                                                <div class="card-title-group align-start mb-2">--}}
{{--                                                    <div class="card-title">--}}
{{--                                                        <h6 class="title">Today Order Amount</h6>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">--}}
{{--                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">--}}
{{--                                                        <div class="nk-sale-data">--}}
{{--                                                            <span class="amount">{{ session()->get('system_settings.currency') }} {{ number_format($orders->pluck('total')->sum(), 2, '.', ',') }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .col -->--}}
{{--                                    <div class="col-lg-6 col-xxl-6">--}}
{{--                                        <div class="card card-bordered">--}}
{{--                                            <div class="card-inner">--}}
{{--                                                <div class="card-title-group align-start mb-2">--}}
{{--                                                    <div class="card-title">--}}
{{--                                                        <h6 class="title">Total Order</h6>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">--}}
{{--                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">--}}
{{--                                                        <div class="nk-sale-data">--}}
{{--                                                            <span class="amount">{{ $orders->pluck('total')->count() }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .col -->--}}
{{--                                    <div class="col-lg-4 col-xxl-6">--}}
{{--                                        <div class="card card-bordered">--}}
{{--                                            <div class="card-inner">--}}
{{--                                                <div class="card-title-group align-start mb-2">--}}
{{--                                                    <div class="card-title">--}}
{{--                                                        <h6 class="title">Today Order Pending</h6>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">--}}
{{--                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">--}}
{{--                                                        <div class="nk-sale-data">--}}
{{--                                                            <span class="amount">{{ $orders->where('order_status', 0)->count() }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .col -->--}}
{{--                                    <div class="col-lg-4 col-xxl-6">--}}
{{--                                        <div class="card card-bordered">--}}
{{--                                            <div class="card-inner">--}}
{{--                                                <div class="card-title-group align-start mb-2">--}}
{{--                                                    <div class="card-title">--}}
{{--                                                        <h6 class="title">Today Order Complete</h6>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">--}}
{{--                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">--}}
{{--                                                        <div class="nk-sale-data">--}}
{{--                                                            <span class="amount">{{ $orders->where('order_status', 1)->count() }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .col -->--}}
{{--                                    <div class="col-lg-4 col-xxl-6">--}}
{{--                                        <div class="card card-bordered">--}}
{{--                                            <div class="card-inner">--}}
{{--                                                <div class="card-title-group align-start mb-2">--}}
{{--                                                    <div class="card-title">--}}
{{--                                                        <h6 class="title">Today Order Cancelled</h6>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">--}}
{{--                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">--}}
{{--                                                        <div class="nk-sale-data">--}}
{{--                                                            <span class="amount">{{ $orders->where('order_status', 2)->count() }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .col -->--}}
{{--                                </div><!-- .row -->--}}
{{--                            </div><!-- .col -->--}}

{{--                            <div class="nk-block-head nk-block-head-sm">--}}
{{--                                <div class="nk-block-between">--}}
{{--                                    <div class="nk-block-head-content">--}}
{{--                                        <h3 class="nk-block-title page-title">Sales Overview</h3>--}}
{{--                                        <div class="nk-block-des text-soft">--}}
{{--                                            <p>Welcome to OrderKaru Dashboard.</p>--}}
{{--                                        </div>--}}
{{--                                    </div><!-- .nk-block-head-content -->--}}
{{--                                    <div class="nk-block-head-content">--}}
{{--                                        <div class="toggle-wrap nk-block-tools-toggle">--}}

{{--                                        </div>--}}
{{--                                    </div><!-- .nk-block-head-content -->--}}
{{--                                </div><!-- .nk-block-between -->--}}
{{--                            </div><!-- .nk-block-head -->--}}

{{--                            <div class="col-xxl-8">--}}
{{--                                <div class="card card-bordered card-full">--}}
{{--                                    <div class="card-inner">--}}
{{--                                        <div class="card-title-group">--}}
{{--                                            <div class="card-title">--}}
{{--                                                <h3 class="nk-block-title page-title">Today Orders</h3>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <table class="datatable-init nowrap table">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="sorting_desc" aria-sort="descending">ID</th>--}}
{{--                                            <th>Date</th>--}}
{{--                                            <th>Name</th>--}}
{{--                                            <th>Contact</th>--}}
{{--                                            <th>Product</th>--}}
{{--                                            <th>Total</th>--}}
{{--                                            <th>Status</th>--}}
{{--                                            <th>Action</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @if( $orders )--}}
{{--                                            @foreach( $orders as $order )--}}
{{--                                                <tr id="rowID-{{ $order['id'] }}">--}}
{{--                                                    <td>{{$order['order_id'] }}</td>--}}
{{--                                                    <td>{{$order['order_time']}}</td>--}}
{{--                                                    <td>{{$order['name_title'] .' '.$order['first_name'] .' '. $order['last_name']}}</td>--}}
{{--                                                    <td>{{$order['mobile_number']}} <br/> {{ $order['alternate_number'] }}</td>--}}
{{--                                                    <td>--}}
{{--                                                        @if($order['order_line_item'])--}}
{{--                                                            <ul style="list-style: decimal;">--}}
{{--                                                                @foreach($order['order_line_item'] as $order_line_items)--}}
{{--                                                                    <li><strong>{{ $order_line_items['product_name'] }} x {{ $order_line_items['product_qty'] }}</strong><br/></li>--}}
{{--                                                                    @if($order_line_items['order_line_item_option'])--}}
{{--                                                                        <ul style="list-style: disc; margin-left: 10px;">--}}
{{--                                                                            @foreach($order_line_items['order_line_item_option'] as $order_line_item)--}}
{{--                                                                                <li><strong>{{ $order_line_item['option_type'] }}</strong> - {{ $order_line_item['option_name'] }}<br/></li>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        </ul>--}}
{{--                                                                    @endif--}}
{{--                                                                @endforeach--}}
{{--                                                            </ul>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td>{{ session()->get('system_settings.currency') }} {{ number_format($order['total'], 2, '.', ',') }}</td>--}}
{{--                                                    <td>--}}
{{--                                                        @if($order['order_status'] == 1)--}}
{{--                                                            <span class="badge badge-success">Complete</span>--}}
{{--                                                        @elseif($order['order_status'] == 2)--}}
{{--                                                            <span class="badge badge-danger">Cancel</span>--}}
{{--                                                        @else--}}
{{--                                                            <span class="badge badge-warning">Pending</span>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--                                                            <a class="btn btn-primary" href='{{ route("order.show", $order['id']) }}'><em class="icon ni ni-edit"></em></a>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div><!-- .card -->--}}
{{--                            </div><!-- .col -->--}}
{{--                        </div><!-- .row -->--}}
{{--                    </div><!-- .nk-block -->--}}
                </div>
            </div>
        </div>
    </div>
@endsection
