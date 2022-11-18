<style>
ul.breadcrumb {
    margin-bottom: 10px;
}
h3.nk-block-title.fw-normal {
    font-size: 22px;
    color: #000000;
}


.col-md-12.bg-light-col-form {
    background: #F6F8FC;
    border-radius: 20px 20px 0px 0px;
    padding-top: 20px !important;
    padding-bottom: 20px !important;
    padding-left: 30px !important;
}


.col-md-12.bg-light-col{
    background: #F6F8FC;
    padding-top: 20px !important;
    padding-bottom: 20px !important;
    padding-left: 30px !important;
}

.card-inner {
    padding: 14px 14px 1.5rem 14px  !important;
}

.small-tag {
    font-size: 14px;
    line-height: 10px;
    color: #000;
    font-weight: 500;
}

.pop-btn {
    padding: 12px 25px !important;
}

input.form-control::placeholder {
    color: #C7CACE;
    font-size: 16px !important;
}

.custom-control-lg .custom-control-label::before, .custom-control-lg .custom-control-label::after { width: 1rem !important; height: 1rem !important; left: -24px !important;top: 8px !important;}


.custom-control-lg:first-child{
    padding-left: 21px;
}

.form-label {
    font-size: 16px;
}

.col-md-12.bg-light-col {
    margin-top: 30px;
    margin-bottom: 20px;
}

.col-md-6.marg-left {
    padding-left: 30px !important;
}

.col-md-6.marg-right {
        padding-right: 30px !important;

}

.col-md-12.marg-left {
    padding-left: 30px !important;
    padding-right: 30px !important;
}


.col-md-12.marg-right {
    padding-left: 30px !important;
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
                                <nav>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("dashboard") }}">  {{ env('APP_NAME') }}</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="{{ route("users.index") }}">{{ $section->heading }}</a></li>
                                        <li class="breadcrumb-item active">{{ $section->title }}</li>
                                    </ul>
                                </nav>
                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>

                            </div>
                        </div><!-- .nk-block-head -->

                        <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->

                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    {!! Form::model($user, ['route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                                    @method($section->method)
                                    <div class="row g-gs">
                                        <div class="col-md-12 bg-light-col-form">
                                            <div class="form-group">
                                                <h3 class="nk-block-title fw-normal">Login Details</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Name</label>
                                                <div class="form-control-wrap">
                                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name', 'required' => 'required', ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Email</label>
                                                <div class="form-control-wrap">
                                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter User Email', 'required' => 'required', ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @if($section->method == 'POST') --}}
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Password</label>
                                                <div class="form-control-wrap">
                                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter User Password' ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-full-name">Confirm Password</label>
                                                <div class="form-control-wrap">
                                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password' ]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        {{-- @endif --}}

                                        <div class="col-md-12 bg-light-col">
                                            <div class="form-group">
                                                <h3 class="nk-block-title fw-normal ">Employee Details</h3>

                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Date of Birth</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('birth_date', null, ['class' => 'form-control user-datepicker', 'placeholder' => 'Enter Date of birth' ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Joining Date</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('joining_date', null, ['class' => 'form-control date-join-picker', 'placeholder' => 'Enter Date of Joining' ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">CNIC #</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('cnic', null, ['class' => 'form-control', 'placeholder' => 'Enter CNIC #','onkeypress' => 'return isNumber(event)', 'data-inputmask' => "'mask': '99999-9999999-9'" ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Phone #</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone #', 'data-inputmask' => "'mask': '9999-9999999'", 'onkeypress' => 'return isNumber(event)' ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Emergency Contact
                                                    Person</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('emergency_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Emergency Contact Person Name', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Emergency Contact #</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::tel('emergency_phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Emergency Contact #', 'data-inputmask' => "'mask': '9999-9999999'", 'onkeypress' => 'return isNumber(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 marg-left marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Address</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Enter Present Address' ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 bg-light-col">
                                            <div class="form-group">
                                                <h3 class="nk-block-title fw-normal ">Other Details</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Annual Leaves</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('no_of_leaves', null, ['class' => 'form-control', 'placeholder' => 'Enter Allowed Annual Leaves (e.g 12)','onkeypress' => 'return isNumber(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">User Role</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('user_type', $roles, null, ['class' => 'form-control form-select', 'required' => 'required',  'placeholder' => 'Select User Role', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  marg-left">
                                            <label class="form-label" for="default-06">Picture</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="image"
                                                           name="image">
                                                    <label class="custom-file-label" for="customFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Status</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::select('status', array(1 => 'Active', 0 => 'Block'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6  marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Check In</label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('check_in', null, ['class' => 'form-control time-picker', 'placeholder' => 'Check In' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Check Out </label>
                                                <div class="form-control-wrap ">
                                                    <div class="form-icon form-icon-left"><em
                                                            class="icon ni ni-calendar"></em></div>
                                                    {!! Form::text('check_out', null, ['class' => 'form-control time-picker', 'placeholder' => 'Check Out' ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 marg-left marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Attendance ID</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('attendance_id', null, ['class' => 'form-control', 'placeholder' => 'Attendance Sheet ID' ]); !!}
                                                </div>
                                            </div>
                                        </div>



                                        @if($section->method == 'PUT')
                                            <div class="col-md-12 marg-left marg-right">
                                                <img class="img-thumbnail user-picture"
                                                     src="{{ asset('pictures/'.$user->picture) }}" alt="picture"
                                                     style="width: 150px;">
                                            </div>

                                        @endif
                                        <div class="col-md-12 bg-light-col">
                                            <div class="form-group">
                                                <h3 class="nk-block-title fw-normal ">Sale Targets</h3>
                                                <small class ="small-tag">(For Sales Person)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Individual Target <small>(in
                                                        USD)</small></label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('target_individual', null, ['class' => 'form-control', 'placeholder' => 'Enter Individual Target', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Individual Percentage <small>(in
                                                        %)</small></label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('perc_individual', null, ['class' => 'form-control', 'placeholder' => 'Enter Individual Percentage', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6  marg-left">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Team Percentage <small>(in
                                                        %)</small></label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('perc_team', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Percentage','onkeypress' => 'return isDecimal(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 marg-right">
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Daily Pitch Target <small>(daily
                                                        bidding target)</small></label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('daily_pitch', null, ['class' => 'form-control', 'placeholder' => 'Enter Daily Pitch Target', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6  marg-left">
                                            @if(isset($user->isallow))
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Allow Approval</label>
                                                <div class="form-control-wrap ">
                                                <div class="custom-control custom-control-lg custom-radio">
                                                    <input type="radio" id="Approve" name="isallow" value="1"
                                                           class="custom-control-input" {!! ($user->isallow == 1) ? 'checked' : "" !!}>
                                                    <label class="custom-control-label"
                                                           for="Approve">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-lg custom-radio">
                                                    <input type="radio" id="Reject" name="isallow" value="0"
                                                           class="custom-control-input" {!! ($user->isallow == 0) ? 'checked' : "" !!}>
                                                    <label class="custom-control-label"
                                                           for="Reject">No</label>
                                                </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="form-group">
                                                <label class="form-label" for="fv-topics">Allow Approval</label>
                                                <div class="form-control-wrap ">
                                                <div class="custom-control custom-control-lg custom-radio">
                                                    <input type="radio" id="Approve" name="isallow" value="1"
                                                           class="custom-control-input">
                                                    <label class="custom-control-label"
                                                           for="Approve">Yes</label>
                                                </div>
                                                <div class="custom-control custom-control-lg custom-radio">
                                                    <input type="radio" id="Reject" name="isallow" value="0"
                                                           class="custom-control-input" >
                                                    <label class="custom-control-label"
                                                           for="Reject">No</label>
                                                </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-12  marg-left">
                                            <div class="form-group">
                                                {!! Form::button(' Save', ['type' => 'submit', 'class' => 'btn btn-primary pop-btn']) !!}
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
        $('.user-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '-3d'
            endDate: '1d'
        });






        jQuery('.date-join-picker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: "yyyy-mm-dd",
            clearBtn: true
        });

    </script>

@endpush
