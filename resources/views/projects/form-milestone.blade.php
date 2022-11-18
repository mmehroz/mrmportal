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
                                    {!! Form::model($teamMilestone, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Team</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('team_id', $teams, null , ['class' => 'form-control form-select select2', 'required' => 'required' ]); !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Team Amount</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('team_amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Amount', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Sales Person</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('sale_id', $bidder_sale, null , ['class' => 'select2 form-control form-select',  'required' => 'required', 'placeholder' => 'Please Select', ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Sale Person Amount</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('sale_amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Target', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Milestone</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('milestone', null, ['class' => 'form-control', 'placeholder' => 'Enter Milestone', 'required' => 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {!! Form::button('<i class="fa fa-check-square-o"></i> Request Update', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                                </div>
                                            </div>
                                        </div>
                                         {!! Form::hidden('project_id', null, []); !!}
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
            $('.select2').select2();
        });

</script>
@endpush
