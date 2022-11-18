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
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("users.index") }}">{{ $section->heading }}</a></li>
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
                                    {!! Form::model($attendance, ['route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                    @method($section->method)
                                    <div class="row g-gs">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Date</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('date', null, ['class' => 'form-control user-datepicker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Routine Check In</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('routine_check_in', auth()->user()->check_in, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Routine Check Out</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('routine_checkout', auth()->user()->check_out, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Today Check In</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('today_check_in', null, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Today Check Out</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('today_check_out', null, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                            </div>
                                        </div>


                                        @if(auth()->user()->user_type == "1" || auth()->user()->user_type == "3" || auth()->user()->user_type == "7" || auth()->user()->user_type == "0" )
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Is Late ?</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('is_late', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Comment </label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Comment']); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::button('<i class="fa fa-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                    </div>

                                   <input type="hidden" name="status" value="0">


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
        $('.user-datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });


    </script>

@endpush
