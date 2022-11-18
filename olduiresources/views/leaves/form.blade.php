@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="components-preview mx-auto">
                        <div class="nk-block-head nk-block-head-lg wide-sm">
                            <div class="nk-block-head-content">
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item"><a href="{{ route("teams.index") }}">{{ $section->heading }}</a></li>
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
                                    {!! Form::model($leaves, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Leave / Half Day ?</label>
                                                    <div class="form-control-wrap ">
                                                        @php
                                                        if($section->method == 'PUT'){
                                                            if($leaves->no_of_days == 0.5){
                                                                $selected = 0;
                                                            }elseif($leaves->no_of_days == 1){
                                                                $selected = 1;
                                                            }
                                                            else{ $selected = 2; }
                                                        }
                                                        else{ $selected = null;}
                                                        @endphp
                                                        {!! Form::select('leave_type', array(0 => "Half Day", 1 => "Full Day", 2 => "Multple Days"), $selected ,['class' => 'select2 form-control form-select', 'placeholder' => 'Please Select', 'required' => 'required']) !!}
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6 from-field {{ $section->method != 'PUT' ? 'd-none' : '' }}">
                                            <div class="form-group">
                                                    <label class="form-label" for="fv-topics">From</label>
                                                    <div class="form-control-wrap ">
                                                      <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::text('date_from', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter From Date', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-6 to-field {{ $section->method != 'PUT' ? 'd-none' : '' }}">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">To</label>
                                                    <div class="form-control-wrap ">
                                                      <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::text('date_to', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter To Date', 'required' => 'required',]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Reason</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('reason', null, ['class' => 'form-control', 'placeholder' => 'Enter Leave Reason', 'required' => 'required', 'rows' => 1]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @if($section->method == 'PUT' && in_array(auth()->user()->user_type,[0,1,3,6,7]))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Status</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('status', array(0 => "Pending", 1 => "Reject", 2 => "Approve"), null,['class' => 'select2 form-control form-select', 'placeholder' => 'Please Select', ]) !!}
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::button('Apply', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2().on('change', function (e) {
                if ($(this).val() == 2){
                    $('.from-field').removeClass('d-none')
                    $('.from-field').find('label').text('From')
                    $('.to-field').removeClass('d-none')
                }
                else if ($(this).val() == 1){
                    $('.from-field').removeClass('d-none')  
                    $('.from-field').find('label').text('Date')
                    $('.to-field').addClass('d-none')
                }
                else{
                    $('.from-field').removeClass('d-none')
                    $('.from-field').find('label').text('Date')
                    $('.to-field').addClass('d-none')        
                }
                });
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
        });

    </script>
@endpush
