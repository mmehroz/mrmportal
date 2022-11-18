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
                                    {!! Form::model($team, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Team Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Name', 'required' => 'required', 'name' => 'name', ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Team Lead</label>
                                                    <div class="form-control-wrap ">
                                                        @php
                                                            // dd(getTeamMembers($team->id));
                                                        @endphp
                                                        @if($section->method != 'PUT')
                                                        {!! Form::select('team_lead', getAllMembers(), null,['class' => 'select2 form-control form-select',  'required' => 'required', 'placeholder' => 'Please Select', ]) !!}
                                                        @else
                                                        {!! Form::select('team_lead', getAllMembers(), getTeamLead($team->id)['member_id'],['class' => 'select2 form-control form-select',  'required' => 'required', 'placeholder' => 'Please Select', ]) !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Members</label>
                                                    <div class="form-control-wrap ">
                                                        @if($section->method != 'PUT')
                                                        {!! Form::select('member_id[]',getAllMembers(), null , ['class' => 'form-control form-select select2', 'required' => 'required', 'multiple', ]); !!}
                                                        @else
                                                        {!! Form::select('member_id[]',getAllMembers(), getTeamMembers($team->id), ['class' => 'form-control form-select select2', 'required' => 'required', 'multiple', ]); !!}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Team Target <small>(in USD)</small></label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::text('team_target', null, ['class' => 'form-control', 'placeholder' => 'Enter Team Target', 'onkeypress' => 'return isDecimal(event)', ]); !!}
                                                    </div>
                                                </div>
                                            </div>
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
