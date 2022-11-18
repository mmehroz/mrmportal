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
                        <li class="breadcrumb-item"><a href="{{ route("projects.index") }}">{{ $section->heading }}</a></li>
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
                    {!! Form::model($project, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
                    @method($section->method)
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-full-name">Title</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter Title', 'required' => 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics">Status</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::select('status', array('Pending' => 'Pending', 'On Hold' => 'On Hold', 'To Do' => 'To Do','Doing' => 'Doing','Done' => 'Done','Sent to client' => 'Sent to client','Completed' => 'Completed','Canceled' => 'Canceled'), null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select status', 'required' => 'required']); !!}

                            </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="fv-full-name">Description</label>
                                    <div class="form-control-wrap">
                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', 'required' => 'required']) !!}
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                        <div class="payment-radio-sec">
                                            <label class="form-label" for="fv-full-name">Type</label>
                                            <div class="payment-radio-btn">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-4">
                                                        <div class="form-check custom-control custom-radio"> @if($section->method != 'PUT')
                                                            <input class="custom-control-input" type="radio" id="project_type_hourly" name="project_type" required="required" value="hourly"> @else
                                                            <input class="custom-control-input" type="radio" id="project_type_hourly" name="project_type" required="required" value="hourly" {{ $project->project_type == 'hourly' ? 'checked=""' : '' }}> @endif
                                                            <label class="custom-control-label" for="project_type_hourly"> Hourly </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-md-4">
                                                        <div class="form-check custom-control custom-radio"> @if($section->method != 'PUT')
                                                            <input class="custom-control-input" type="radio" id="project_type_fixed" name="project_type" value="fixed" autocomplete="off"> @else
                                                            <input class="custom-control-input" type="radio" id="project_type_fixed" name="project_type" value="fixed" {{ $project->project_type == 'fixed' ? 'checked=""' : '' }}> @endif
                                                            <label class="custom-control-label" for="project_type_fixed"> Fixed </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics">Amount <small>(in USD)</small></label>
                                    <div class="form-control-wrap ">
                                        {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount', 'required' => 'required', 'onkeypress' => 'return isDecimal(event)']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics">Team</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::select('team_id', $teams, null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select team', 'required' => 'required']); !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-topics">Profile</label>
                                    <div class="form-control-wrap ">
                                        {!! Form::select('profile_id', $profile, null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select profile', 'required' => 'required']); !!}
                                    </div>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Sale</label>
                                        <div class="form-control-wrap ">
                                            {!! Form::select('sale_id', $sale, null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select sales person']); !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Bidder</label>
                                        <div class="form-control-wrap ">
                                            {!! Form::select('bidder_id', $bidder, null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select bidder']); !!}
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Start Date</label>
                                        <div class="form-control-wrap ">
                                          <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                            {!! Form::text('start_date', null, ['class' => 'form-control project-datepicker', 'placeholder' => 'Enter Start Date', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">End Date</label>
                                        <div class="form-control-wrap ">
                                           <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                            {!! Form::text('end_date', null, ['class' => 'form-control project-datepicker', 'placeholder' => 'Enter End Date', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Customer</label>
                                        <div class="form-control-wrap ">
                                            {!! Form::select('customer_id', $customer, null,['class' => 'form-control form-select select2', 'placeholder' => 'Select customer']); !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Members</label>
                                        <div class="form-control-wrap ">
                                              @if($section->method != 'PUT')
                                            {!! Form::select('members[]',$members, null, ['class' => 'form-control form-select select2',  'multiple']); !!}
                                            @else
                                            {!! Form::select('members[]',$members, getProjectMembers($project->id), ['class' => 'form-control form-select select2',  'multiple']); !!}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="fv-topics">Attachments</label>
                                          <div class="form-control-wrap">
                                            <div class="custom-file">
                                            <input type="file" name="attachments[]" multiple class="custom-file-input" id="attachments">
                                            <label class="custom-file-label" for="attachments">Choose files</label>
                                        </div>
                                     </div>
                                </div>    
                             </div> 
                             @isset($project->attachment_id)
                             <div class="col-md-12">
                                <div class="form-group">
                                    {!!  getFiles($project->attachment_id) !!}
                                </div>    
                             </div>
                             @endisset




                        {{--     @if($section->method != 'POST')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fv-full-name">Sorting Order</label>
                                    <div class="form-control-wrap">
                                        {!! Form::text('sorting_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Sorting Order', 'required' => 'required', 'onkeypress' => 'return isNumber(event)', 'maxlength' => 3]) !!}
                                    </div>
                                </div>
                            </div>
                            @endif --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::button('<i class="fa fa-check-square-o"></i> Save', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
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
@section('scripts')
<script>
        $(document).ready(function() {
            $('.select2').select2({
                     placeholder: function(){
                            $(this).data('placeholder');
                        },
            });
        });

        $('.project-datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '1d',
            // endDate: '1d'
        });
</script>

@endsection
