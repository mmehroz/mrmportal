@extends('layouts.sales')

@push('styles')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    {{-- <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css"> --}}
    <style>

    .site-header__title {
    text-align: center;
    font-family: sans-serif;
    font-weight: bolder;
    font-size: 70px;
     }

     .main-content {
    text-align: center;
     }

    .main-content i {
    color: #15BC58;
    font-size: 100px;
    padding: 30px 0px;
    }

    .main-content p {
     font-size: 16px;
    font-family: sans-serif;
    font-weight: 600;
    }

    a {
    color: #15BC58;
    font-size: 16px;
    font-family: sans-serif;
    text-decoration: underline;
    font-weight: 600;
    }

    </style>
@endpush
@section('content')
    <div class="nk-content " style="width: 80%;margin: auto;">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg" style="text-align: center;">
                            <div class="nk-block-head-content">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <img src="{{ asset($order->brand->picture) }}" alt="{{ $order->brand->name }}" width="250px" />
                                    </div>
                                </div>
                            </div>
                        </div>
                     <header class="site-header" id="header">
                            <h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
                        </header>

                        <div class="main-content">
                            <i class="fas fa-check"></i>
             <p class="main-content__body" data-lead-id="main-content-body">Thank you very much for filling out our form. <br>
             Your eBook is waiting for you in your inbox, with one secret and special bonus :)
             </p>
{{--                   <a href="#"> Go Back to our homepage</a>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
