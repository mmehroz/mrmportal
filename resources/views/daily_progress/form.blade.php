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
                                        <li class="breadcrumb-item"><a href="{{ route("daily_progress.index") }}">{{ $section->heading }}</a></li>
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
                                    {!! Form::model($progress, ['route' => $section->route, 'class' => 'form-validate', 'files' => true, 'enctype' => 'multipart/form-data','autocomplete' => 'off']) !!}
                                    @method($section->method)
                                        <div class="row g-gs">
{{--                                            <div class="col-md-12">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label class="form-label" for="fv-topics">Project</label>--}}
{{--                                                    <div class="form-control-wrap ">--}}
{{--                                                        {!! Form::select('project_id', $projects , null, ['class' => 'form-control form-select select2', 'placeholder' => 'Select a project', ]); !!}--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-12">
                                                <label class="form-label" for="fv-topics">Trello Link</label>
                                                <div class="form-control-wrap ">
                                                    {!! Form::text('project_id', null, ['class' => 'form-control', 'placeholder' => 'Enter Trello Link ']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Date</label>
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::text('date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Enter Date ', ]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Time</label>
                                                    <div class="row">
                                                    <div class="col-md-6 ">
                                                        <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::select('time_hrs', array('0' => 0, '1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'10' => 10,'11' => 11,'12' => 12 ) , null, ['class' => 'form-control form-select select2', 'placeholder' => 'Enter Hours eg. 2', ]) !!}
                                                    </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                                        {!! Form::select('time_mins', array('0' => 0, '1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8,'9' => 9,'10' => 10,'11' => 11,'12' => 12,'13' => 13,'14' => 14,'15' => 15,'16' => 16,'17' => 17,'18' => 18,'19' => 19,'20' => 20,'21' => 21,'22' => 22,'23' => 23,'24' => 24,'25' => 25,'26' => 26,'27' => 27,'28' => 28,'29' => 29,'30' => 30, '31' => 31,'32' => 32,'33' => 33,'34' => 34,'35' => 35,'36' => 36,'37' => 37,'38' => 38,'39' => 39,'40' => 40, '41' => 41,'42' => 42,'43' => 43,'44' => 44,'45' => 45,'46' => 46,'47' => 47,'48' => 48,'49' => 49,'50' => 50,'51' => 51,'52' => 52,'53' => 53,'54' => 54,'55' => 55,'56' => 56,'57' => 57,'58' => 58,'59' => 59) ,null, ['class' => 'form-control form-select select2 ', 'placeholder' => 'Enter Mins eg. 35' ,]) !!}
                                                    </div>

                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="fv-full-name">Description</label>
                                                    <div class="form-control-wrap">
                                                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Description', ]) !!}
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
@push('scripts')
<script>

    $(document).ready(function() {
        $('.select2').select2({
                  placeholder: function(){
                    $(this).data('placeholder');
                }
            });
        });


        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: '1d'
        });
</script>
@endpush
