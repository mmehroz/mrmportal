<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Title  -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
<link rel="preconnect" href="https://fonts.gstatic.com">

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">

    <!-- StyleSheets  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dashlite.css?ver=2.2.0') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.css?ver=2.2.0') }}"  id="skin-default">
    <link rel="stylesheet" href="{{ asset('assets/css/editors/tinymce.css?ver=2.2.0') }}">



    <!-- BEGIN Page Level CSS-->
    @stack('styles')
    <style>
        .smallDiv {
            width: 0% !important;
        }
        .smallDiv .nk-sidebar-head {
            border-color: #e5e9f2;
            background: #101924;
            height: 70px;
        }

        .fullWidthDiv {
            width: 100% !important;
            background: #f7f7f7;
            padding-left: 0px !important;
        }

        .dark-mode .nk-content {
            background: #141c26;
        }

        .dark-mode .nk-sidebar-head{
            background-color: #101924 !important;
        }

        .nk-sidebar-head {
            min-height: 69px;
        }
    </style>
    <!-- END Page Level CSS-->

    @livewireStyles
</head>

<body class="nk-body bg-lighter npc-general has-sidebar">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- sidebar @s -->
    @include('partials.sidebar')
    <!-- sidebar @e -->
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('partials.header')
            <!-- main header @e -->
            <!-- content @s -->
            @yield('content')
            <!-- content @e -->


            <!-- sample modal content -->
            <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Form with validation -->
                            {!! Form::open([
                                'id' => 'delete-frm',
                                'class' => "form-validate is-alter",
                                'method' => 'DELETE'
                            ]) !!}
                            <div class="modal-body text-center">
                                {{ csrf_field() }}
                                @method('DELETE')
                                <div class="swal2-icon swal2-warning swal2-icon-show" style="display: flex;"><div class="swal2-icon-content">!</div></div>
                                <h2 class="swal2-title" id="swal2-title text-center">Are you sure?</h2>
                                <div id="swal2-content" class="swal2-html-container text-center">You won't be able to revert this!</div>
                                <div class="swal2-actions">
                                    <button type="submit" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block; border-left-color: rgb(30, 224, 172); border-right-color: rgb(30, 224, 172);">Yes, delete it!</button>
                                    <button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: inline-block;" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- footer @s -->
            @include('partials.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js?ver=2.2.0') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js?ver=2.2.0') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/charts/gd-default.js?ver=2.2.0') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/libs/editors/tinymce.js?ver=2.2.0') }}"></script>
<script src="{{ asset('assets/js/editors.js?ver=2.2.0') }}"></script>
<script src="{{ asset('assets/js/select2.js?ver=2.0.0') }}"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<!-- BEGIN PAGE LEVEL JS-->
@stack('scripts')
    <script>
        $(document).ready(function() {
            $(":input").inputmask();
        });

        setTimeout(function(){
            $('.alert').remove();
        }, 5000);

        $(document).on("click", ".deleteBtnModal", function () {
            var deleteRoute = $(this).data('route');
            $("#delete-frm").attr('action', deleteRoute);
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }


        function isDecimal(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && charCode > 46) && (charCode < 46 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>


@yield('scripts')
<!-- END PAGE LEVEL JS-->
@livewireScripts
</body>

</html>










{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="utf-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--    <!-- CSRF Token -->--}}
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--    <title>{{ config('app.name', 'Laravel') }}</title>--}}

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--</head>--}}
{{--<body>--}}
{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav mr-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ml-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                            </li>--}}
{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}
{{--</body>--}}
{{--</html>--}}
