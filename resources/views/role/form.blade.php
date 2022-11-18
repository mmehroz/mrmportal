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
                                        <li class="breadcrumb-item"><a href="{{ route("roles.index") }}">{{ $section->heading }}</a></li>
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
                                    {!! Form::model($role, ['route' => $section->route, 'class' => 'form-validate', 'autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
                                                  @php
                                                     $disabled = $section->method == 'PUT' ? 'disabled' : '';
                                                   @endphp
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Role Name</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter Role Name', 'required' => 'required', $disabled , ]) !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-topics">Status</label>
                                                    <div class="form-control-wrap ">
                                                        {!! Form::select('status', array(1 => 'Yes', 0 => 'No'), null, ['class' => 'form-control form-select', 'placeholder' => 'Select a option', 'required' => 'required', ]); !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr/>
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Roles Permissions</label>
                                                </div>
                                            </div>

                                            <table class="table">
                                                <tbody>
                                                @if( $permissions )
                                                    @foreach( $permissions->groupby('group') as $name => $permission )
                                                        <tr>
                                                            <td colspan="4">{{$name}}</td>
                                                        </tr>
                                                        <tr>
                                                        @foreach($permission as $per)
                                                            <td>
                                                                <div class="custom-control custom-switch">
                                                                    @if(in_array($per->name, $rolePermissions))
                                                                        @php $checkExistvalue = 'checked' @endphp
                                                                    @else
                                                                        @php $checkExistvalue = ''  @endphp
                                                                    @endif
                                                                    <input name="permissions[{{ $per->name }}]" type="checkbox" class="custom-control-input" id="{{ $per->name }}" value="{{ $per->name }}" {{ $checkExistvalue }} autocomplete="off">
                                                                    <label class="custom-control-label" for="{{ $per->name }}">{{ $per->display_name }}</label>
                                                                </div>
                                                            </td>
                                                        @endforeach
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>

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
