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
                                                    {!! Form::text('date', null, ['class' => 'form-control user-datepicker', 'placeholder' => 'Date' , 'readonly']); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Routine Check In</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('routine_check_in', null, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                                <center><small id="routine_check_in"
                                                               class="form-text text-danger"> {{ $old_data['routine_check_in'] ?? ""  }}</small>
                                                </center>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Routine Check Out</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('routine_checkout', null, ['class' => 'form-control time-picker', 'placeholder' => 'Date' ]); !!}
                                                </div>
                                                <center><small id="routine_checkout"
                                                               class="form-text text-danger"> {{ $old_data['routine_checkout'] ?? ""  }}</small>
                                                </center>
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
                                                <center><small id="today_check_in"
                                                               class="form-text text-danger"> {{ $old_data['today_check_in'] ?? ""  }}</small>
                                                </center>
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
                                                <center><small id="today_check_out"
                                                               class="form-text text-danger"> {{ $old_data['today_check_out'] ?? ""  }}</small>
                                                </center>
                                            </div>
                                        </div>


                                        @if(auth()->user()->user_type == "1" || auth()->user()->user_type == "3" || auth()->user()->user_type == "7" || auth()->user()->user_type == "0" )
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Is Late ?</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('is_late', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                </div>
                                                @php   if(isset($old_data)){  @endphp
                                                    @if($old_data['is_late'] == 1)
                                                        <center>
                                                            <small id="is_late" class="form-text text-danger">
                                                                Yes
                                                            </small>
                                                        </center>
                                                    @else
                                                        <center>
                                                            <small id="is_late" class="form-text text-danger">
                                                                No
                                                            </small>
                                                        </center>
                                                    @endif
                                                @php  }  @endphp
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Comment </label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Comment']); !!}
                                                </div>
                                                <center>
                                                    <small id="description"
                                                               class="form-text text-danger"> {{ $old_data['description'] ?? ""  }}
                                                    </small>
                                                </center>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {!! Form::button('<i class="fa fa-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    @php   if(isset($old_data)){  @endphp
                                        <input type="hidden" name="status" value="0">
                                    @php   } else {  @endphp
                                        <input type="hidden" name="status" value="1">
                                    @php   }   @endphp


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
