@extends('layouts.dashboard')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>
                            <nav>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>
                                    <li class="breadcrumb-item active">{{ $section->title }}</li>
                                </ul>
                            </nav>
                        </div><!-- .nk-block-head-content -->
                       @if((in_array('create-project', getUserPermissions())))
                        <div class="nk-block-head-content">
                            <a href="{{ route("projects.create") }}" class="btn btn-primary">Add New {{ $section->title }}</a>
                        </div><!-- .nk-block-head-content -->
                        @endif
                    </div><!-- .nk-block-between -->
                </div>

                <!-- main alert @s -->
                @include('partials.alerts')
                <!-- main alert @e -->

                <div class="components-preview  mx-auto">
                    <div class="nk-block nk-block-lg">
                     

                <div class="components-preview  mx-auto">
                    <div class="nk-block nk-block-lg">
                        <div class="card card-preview">
                            <div class="card-inner">
                                <table class="datatable-init nowrap table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Deadline</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if( $projects )
                                        @foreach( $projects as $key => $project )
                                            <tr id="rowID-{{ $key }}">
                                                <td>{{ $key }}</td>
                                                <td>{{$project->title}}</td>
                                                <td>{!! getAmountFormat($project->amount)  !!}</td>
                                                <td>
                                                    @if($project->status == 'Pending' || $project->status == 'On Hold' || $project->status == 'To Do' )
                                                     <span class="badge badge-dim badge-warning">{{ $project->status }}</span>
                                                    @elseif($project->status == 'Doing'  )

                                                         <span class="badge badge-dim badge-primary">{{ $project->status }}</span>

                                                    @elseif($project->status == 'Done' || $project->status == 'Sent to client' )

                                                       <span class="badge badge-dim badge-info">{{ $project->status }}</span>

                                                    @elseif($project->status == 'Completed'  )

                                                       <span class="badge badge-dim badge-success">{{ $project->status }}</span>
                                                    @elseif($project->status == 'Canceled'  )

                                                       <span class="badge badge-dim badge-danger">{{ $project->status }}</span>
                                                    @endif

                                                    </td>                                                
                                                 <td>{!! daysLeft($project->end_date)  !!}</td>
                                                 <td>{{ $project->start_date }}</td>
                                                 <td>{{ $project->end_date }}</td>
                                                  <td>
                                                       {{-- @if((in_array('update-project', getUserPermissions()))) --}}
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            {{-- <a class="btn btn-primary" href='{{ route("projects.edit", $project->id) }}'><em class="icon ni ni-edit"></em></a> --}}
                                                            {{-- <a class="btn btn-success btn-milestone"  style="color: #fff;"  data-project-id="{{ $project->id }}" data-toggle="modal" data-target="#myModal" ><em class="icon ni ni-money"></em></a> --}}
                                                            {{-- <a class="btn btn-info btn-comment"  style="color: #fff;"  data-project-id="{{ $project->id }}" data-toggle="modal" data-target="#myModal1" ><em class="icon ni ni-comments"></em></a> --}}
                                                            <a class="btn btn-warning" href="{{ route("projects.show", $project->id) }}"><em class="icon ni ni-eye-alt-fill"></em></a>
                                                        </div>
                                                        {{-- @endif --}}
                                                        </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
</div>

{{--  Project Milestone Modal --}}
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Project Milestone</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST" action="{{ route('project_milestone.store') }}" autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Milestone Amount <small>(in USD)</small></label>
                                <div class="form-control-wrap">
                                    {!! Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Enter Amount ', 'required' => 'required', 'onkeypress' => 'return isDecimal(event)']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fv-full-name">Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left"><em class="icon ni ni-calendar"></em></div>
                                    {!! Form::text('date', null, ['class' => 'form-control  datepicker', 'placeholder' => 'Enter Bid Date ', 'required' => 'required']) !!}
                                    {!! Form::text('project_id', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'project_id']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

{{--  Project Comments Modal --}}
    <div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Comment</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="projectCommentForm" class="form-validate is-alter" method="POST" action="{{ route('project_progress.store') }}" enctype='multipart/form-data' autocomplete="off">

                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label class="form-label" for="fv-full-name">Comment</label>
                                <div class="form-control-wrap">
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Comment ', 'required' => 'required']) !!}
                                </div>
                            </div>
                            </div>

                          <div class="form-group row">
                            <div class="col-md-12">
                               <label class="form-label" for="fv-topics">Members</label>
                                <div class="form-control-wrap ">
                                  {!! Form::select('members[]', getAllMembers(), null, ['class' => 'form-control form-select select2',  'multiple']); !!}
                                </div>
                            </div>
                        </div>
                         <div class="form-group row">
                            <div class="col-md-12">
                               <label class="form-label" for="fv-topics">Attachments</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" name="attachments[]" multiple class="custom-file-input" id="attachments">
                                            <label class="custom-file-label" for="attachments">Choose files</label>
                                        </div>
                                    </div>
                            </div>
                             {!! Form::hidden('project_id', null, ['class' => 'form-control', 'required' => 'required', 'id' => 'comment_project_id']) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@push('scripts')
    <script>

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            // startDate: '-3d'
            endDate: '1d'
        });

        $(document).on('click', '.btn-milestone', function(event) {
            $('#project_id').val($(this).attr("data-project-id"))
        });

        $(document).on('click', '.btn-comment', function(event) {
             $('#comment_project_id').val($(this).attr("data-project-id"))
        });

        // $('#attachments').change(function() {
        //     for (var i = 0; i < $('#attachments')[0].files.length; i++) {
        //         $('#fileNames').append('<p>'+$('#attachments')[0].files[i].name+'</p>')
        //     }
        // });
    </script>
@endpush
