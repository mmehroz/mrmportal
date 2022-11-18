    @extends('layouts.dashboard')

    @section('content')
    <div class="nk-content ">
    <div class="container-fluid">
    <div class="nk-content-inner">
    <div class="nk-content-body">
    {{--                    <div class="nk-block-head nk-block-head-sm">--}}
    {{--                        <div class="nk-block-between">--}}
    {{--                            <div class="nk-block-head-content">--}}
    {{--                                <h2 class="nk-block-title fw-normal">{{ $section->title }}</h2>--}}
    {{--                                <nav>--}}
    {{--                                    <ul class="breadcrumb">--}}
    {{--                                        <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">{{ env('APP_NAME') }}</a></li>--}}
    {{--                                        <li class="breadcrumb-item"><a href="{{ route("projects.index") }}">{{ $section->heading }}</a></li>--}}
    {{--                                        <li class="breadcrumb-item active">{{ $projectDetails->title }}</li>--}}
    {{--                                    </ul>--}}
    {{--                                </nav>--}}
    {{--                            </div><!-- .nk-block-head-content -->--}}
    {{--                            <div class="nk-block-head-content">--}}
    {{--                                <div class="btn-group" role="group" aria-label="Basic example">--}}
    {{--                                    <a class="btn btn-primary btn-comment"  style="color: #fff;" data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#myModal1" ><em class="icon ni ni-comments"></em></a>--}}
    {{--                                    <a class="btn btn-success btn-milestone"  style="color: #fff;" data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#myModal" ><em class="icon ni ni-money"></em></a>--}}
    {{--                                </div>--}}
    {{--                            </div><!-- .nk-block-head-content -->--}}
    {{--                        </div>--}}
    {{--                    </div><!-- .nk-block-head -->--}}


            <!-- main alert @s -->
            @include('partials.alerts')

            <div class="nk-msg">
                <div class="nk-msg-body bg-white profile-shown">
                    <div class="nk-msg-head">
                        <div class="row g-1">
                            <div class="col-9">
                                <h3 class="title" style="margin-bottom: 0px;">{{ $projectDetails->title }}</h3>
                                <span class="sub-text">{{ $projectDetails->profile->name }}</span>
                            </div>
                            <div class="col-3`">
                                <span class="sub-text">{!! daysLeft($projectDetails->end_date)  !!}</span>
                            </div>
                        </div>
                        <a href="#" class="nk-msg-profile-toggle profile-toggle active"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                    <!-- .nk-msg-head -->
    <div class="nk-msg-reply nk-reply" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                        <div class="nk-msg-head">
                            <div class="project-details" style="margin-top: 1rem;">
                                <p>{{ $projectDetails->description }}</p>
                            </div>
                            @if($projectDetails->attachment_id)
                                {!!  getFiles($projectDetails->attachment_id) !!}
                            @endif
{{--                                                    <a href="#" class="nk-msg-profile-toggle profile-toggle active"><em class="icon ni ni-arrow-left"></em></a>--}}
                        </div>
                        <div class="simplebar-content" style="padding: 0px;">
                            @foreach($projectDetails->comments->groupBy(function($item) {
                                            return $item->created_at->format('d-M-Y');
                                       }) as $key => $comments)
                                <div class="nk-reply-meta">
                                    <div class="nk-reply-meta-info"><strong>{{ $key }}</strong></div>
                                </div>
                                @foreach($comments as $comment)
                                    <div class="nk-reply-item">
                                        <div class="nk-reply-header">
                                            <div class="user-card">
                                                <div class="user-avatar sm bg-blue">
                                                    {!! getUserImage($comment->user->id) !!}
                                                </div>
                                                <div class="user-name">{{ $comment->user->name }}</div>
                                            </div>
                                            <div class="date-time">{{ formatDate($comment->created_at) }} at {{ formatTime($comment->created_at) }}</div>
                                        </div>
                                        <div class="nk-reply-body">
                                            <div class="nk-reply-entry entry">
                                                {{ $comment->description }}
                                            </div>
                                            @if(!empty($comment->attachment_id))
                                                {!!  getFiles($comment->attachment_id) !!}
                                            @endif

                                        @if(count($comment->comment_members) > 0)
                                            <div class="project-meta attach-foot">
                                                <ul class="project-users g-1">
                                                    @foreach($comment->comment_members as $key => $comment_user)
                                                        <li data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$comment_user->user->name}}">
                                                            <div class="user-avatar sm bg-primary">
                                                                 {!! getUserImage($comment_user->user->id) !!}
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1373px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar" style="height: 65px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div>
                    <!-- .nk-reply -->
<div class="nk-msg-profile visible" data-simplebar="init">
<div class="simplebar-wrapper" style="margin: 0px;">
    <div class="simplebar-height-auto-observer-wrapper">
        <div class="simplebar-height-auto-observer"></div>
    </div>
    <div class="simplebar-mask">
        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
            <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                <div class="simplebar-content" style="padding: 0px;">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                @if($projectDetails->customer_id)
                                    <div class="user-card user-card-s2 mb-2">
                                        <div class="user-avatar md bg-primary"> 
                                            {!! getUserImage(getUserDetail($projectDetails->customer_id)->id) !!} 
                                        </div>
                                        <div class="user-info">
                                            <h5>{{ getUserDetail($projectDetails->customer_id)->name }}</h5> <span class="sub-text">Customer</span>
                                        </div>
                                    </div>
                                @endif
                                 <div class="user-card user-card-s2 mb-2">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="btn btn-primary btn-comment"  style="color: #fff;" data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#myModal1" ><em class="icon ni ni-comments"></em></a>
                                            @if(auth()->user()->user_type != 2)
                                            <a class="btn btn-success btn-milestone"  style="color: #fff;" data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#myModal" ><em class="icon ni ni-money"></em></a>
                                            @endif
                                        </div>
                                    </div>
                                <div class="row text-center g-1">
                                    <div class="col-6">
                                        <div class="profile-stats"> <span class="amount">{{ count($projectDetails->comments) }}</span> <span class="sub-text">Comments</span> </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="profile-stats"> <span class="amount">{{ $projectDetails->status }}</span> <span class="sub-text">Status</span> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card-inner -->
                            <div class="card-inner">
                                <div class="aside-wg">
                                    <h6 class="overline-title-alt mb-2">Assigned Account</h6>
                                    <ul class="align-center g-2">
                                        <div class="project-meta">
                                            <ul class="project-users g-1">
                                                @if($projectDetails->projectUser)
                                                    @foreach($projectDetails->projectUser as $key => $project_user)
                                                        @foreach($project_user->user as $user)
                                                                <li data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$user->name}}">
                                                                    <div class="user-avatar sm bg-primary">{!! getUserImage($user->id) !!}</div>
                                                                </li>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </ul>
                                </div>
                                <div class="aside-wg">
                                    <h6 class="overline-title-alt mb-2">Additional</h6>
                                    <div class="row gx-1 gy-3">
                                        <div class="col-6"> <span class="sub-text">Project ID: </span> <span>{{ $projectDetails->id }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">Project Type:</span> <span>{{ $projectDetails->project_type }}</span> </div>
                                        @if((in_array('read-daily-target', getUserPermissions())))
                                        <div class="col-6"> <span class="sub-text">Amount:</span> <span>{!! getAmountFormat($projectDetails->amount)  !!}</span> </div>
                                        <div class="col-6" data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#milestoneModal" > <span class="sub-text">Amount Received:</span><span class="badge badge-outline-primary">{!! getAmountFormat($projectMilestone->sum('amount')) !!} </span> </div>
                                        <div class="col-12">
                                            <div class="progress progress-lg">    <div class="progress-bar" data-progress="{{ number_format($projectMilestone->sum('amount') * 100 / $projectDetails->amount) }}">{{ number_format($projectMilestone->sum('amount') * 100 / $projectDetails->amount) }}%</div></div>
                                        </div>
                                        @endif
                                        <div class="col-6"> <span class="sub-text">Profile:</span> <span>{{ $projectDetails->profile->name }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">Team:</span> <span>{{ $projectDetails->team->name }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">Sales Person:</span> <span>{{ $projectDetails->sale->name ?? 'n/a' }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">Bidder:</span> <span>{{ $projectDetails->bidder->name ?? 'n/a' }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">Start Date:</span> <span>{{ formatDate($projectDetails->start_date) }}</span> </div>
                                        <div class="col-6"> <span class="sub-text">End Date:</span> <span>{{ formatDate($projectDetails->end_date) }}</span> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- .card-inner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="simplebar-placeholder" style="width: auto; height: 713px;"></div>
</div>
<div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
    <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
</div>
<div class="simplebar-track simplebar-vertical" style="visibility: visible;">
    <div class="simplebar-scrollbar" style="height: 267px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
</div>
</div>
<!-- .nk-msg-profile -->
</div>
<!-- .nk-msg-body -->
</div>
            <!-- main alert @e -->
    {{--                    <div class="nk-block nk-block-lg">--}}
    {{--                        <div class="row g-gs">--}}
    {{--                            <div class="col-md-9">--}}
    {{--                                <div class="card card-bordered">--}}
    {{--                                    <div class="card-inner">--}}
    {{--                                        <h2>{{ $projectDetails->title }}</h2><hr/>--}}
    {{--                                        <p>{{ $projectDetails->description }}</p>--}}
    {{--                                        <h4><strong>Attachments</strong></h4>--}}
    {{--                                        {!!  getFiles($projectDetails->attachment_id) !!}--}}
    {{--                                    </div>--}}
    {{--                                </div><!-- Project Detail -->--}}
    {{--                                <div class="card card-bordered">--}}
    {{--                                    <div class="card-inner">--}}
    {{--                                        <h4><strong>Project Milestone</strong></h4>--}}
    {{--                                        <table class="table">--}}
    {{--                                            <thead>--}}
    {{--                                            <tr>--}}
    {{--                                                <th>Date</th>--}}
    {{--                                                <th>Amount</th>--}}
    {{--                                                <th>Action</th>--}}
    {{--                                            </tr>--}}
    {{--                                            </thead>--}}
    {{--                                            <tbody>--}}
    {{--                                            @if( $projectMilestone )--}}
    {{--                                                @foreach( $projectMilestone as $milestone )--}}
    {{--                                                    <tr>--}}
    {{--                                                        <td>{{ $milestone->date }}</td>--}}
    {{--                                                        <td>{{ $milestone->amount }}</td>--}}
    {{--                                                        <td>--}}
    {{--                                                            <div class="btn-group" role="group" aria-label="Basic example">--}}
    {{--                                                                <a class="btn btn-primary" href='{{ route("projects.edit", $milestone->id) }}'><em class="icon ni ni-edit"></em></a>--}}
    {{--                                                            </div>--}}
    {{--                                                        </td>--}}
    {{--                                                    </tr>--}}
    {{--                                                @endforeach--}}
    {{--                                            @endif--}}
    {{--                                            </tbody>--}}
    {{--                                        </table>--}}
    {{--                                    </div>--}}
    {{--                                </div><!-- Milestone Card -->--}}
    {{--                            </div><!-- Col 9 close -->--}}
    {{--                            <div class="col-md-3">--}}
    {{--                                <div class="card card-bordered">--}}
    {{--                                    <div class="card-inner">--}}
    {{--                                        <p><strong>Status: </strong>{{ $projectDetails->status }}</p>--}}
    {{--                                        <p><strong>Type: </strong>{{ $projectDetails->project_type }}</p>--}}
    {{--                                        <p><strong>Amount: </strong>{{ $projectDetails->amount }}</p>--}}
    {{--                                        <p><strong>Amount Received: </strong>{{ $projectMilestone->sum('amount') }}</p>--}}
    {{--                                        <p><strong>Profile: </strong>{{ $projectDetails->profile->name }}</p>--}}
    {{--                                        <p><strong>Team: </strong>{{ $projectDetails->team->name }}</p>--}}
    {{--                                        <p><strong>Sales Person: </strong>{{ $projectDetails->sale->name ?? 'n/a' }}</p>--}}
    {{--                                        <p><strong>Bidder: </strong>{{ $projectDetails->bidder->name ?? 'n/a' }}</p>--}}
    {{--                                        <p><strong>Customer: </strong>{{ $projectDetails->customer->name ?? 'n/a' }}</p>--}}
    {{--                                        <p><strong>Start Date: </strong>{{ formatDate($projectDetails->start_date) }}</p>--}}
    {{--                                        <p><strong>End Date: </strong>{{ formatDate($projectDetails->end_date) }}</p>--}}
    {{--                                    </div>--}}
    {{--                                </div><!-- .nk-block -->--}}
    {{--                            </div><!-- Col 3 close -->--}}
    {{--                        </div>--}}
    {{--                        <div class="row g-gs">--}}
    {{--                            <div class="col-md-12">--}}
    {{--                            <div class="card card-bordered">--}}
    {{--                                <div class="card-inner">--}}
    {{--                                    <div class="row g-gs">--}}
    {{--                                        <div class="col-md-8"><h4><strong>Activity:</strong></h4></div>--}}
    {{--                                        <div class="col-md-4">--}}
    {{--                                            <a class="btn btn-primary btn-comment" style="color: #fff;"  data-project-id="{{ $projectDetails->id }}" data-toggle="modal" data-target="#myModal1" ><em class="icon ni ni-comments"></em></a>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}

    {{--                                    @foreach($projectDetails->comments->groupBy(function($item) {--}}
    {{--                                                 return $item->created_at->format('d-M-Y');--}}
    {{--                                            }) as $key => $comments)--}}
    {{--                                        <div class="nk-reply-meta" style="margin: 0px;">--}}
    {{--                                            <div class="nk-reply-meta-info"><strong>{{ $key }}</strong></div>--}}
    {{--                                        </div>--}}
    {{--                                        @foreach($comments as $comment)--}}
    {{--                                            <div class="nk-reply-item" style="padding: 2rem 0rem;">--}}
    {{--                                                <div class="nk-reply-header">--}}
    {{--                                                    <div class="user-card">--}}
    {{--                                                        <div class="user-avatar sm bg-blue">--}}
    {{--                                                            <span>{{ getNameInitials($comment->user->name) }}</span>--}}
    {{--                                                        </div>--}}
    {{--                                                        <div class="user-name">{{ $comment->user->name }}</div>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="date-time">{{ formatDate($comment->created_at) }} at {{ formatTime($comment->created_at) }}</div>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="nk-reply-body">--}}
    {{--                                                    <div class="nk-reply-entry entry">--}}
    {{--                                                        {{ $comment->description }}--}}
    {{--                                                    </div>--}}
    {{--                                                    @if(!empty($comment->attachment_id))--}}
    {{--                                                        {!!  getFiles($comment->attachment_id) !!}--}}
    {{--                                                    @endif--}}

    {{--                                                    @if(count($comment->comment_members) > 0)--}}
    {{--                                                        <div class="project-meta attach-foot">--}}
    {{--                                                            <ul class="project-users g-1">--}}
    {{--                                                                @foreach($comment->comment_members as $key => $comment_user)--}}
    {{--                                                                    <li data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$comment_user->user->name}}">--}}
    {{--                                                                        <div class="user-avatar sm bg-primary"><span>{{ getNameInitials($comment_user->user->name) }}</span></div>--}}
    {{--                                                                    </li>--}}
    {{--                                                                @endforeach--}}
    {{--                                                            </ul>--}}
    {{--                                                        </div>--}}
    {{--                                                    @endif--}}
    {{--                                                </div>--}}
    {{--                                            </div>--}}
    {{--                                        @endforeach--}}
    {{--                                    @endforeach--}}





    {{--                                    @foreach($projectDetails->comments as $key => $comment)--}}
    {{--                                        <div class="row">--}}
    {{--                                            <div class="col-md-1">--}}
    {{--                                                <img src="{{ asset('images/comment_user.png') }}" width="50px">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="col-md-11">--}}
    {{--                                                <p><strong>{{ $comment->user->name }}</strong> <span>{{ formatDate($comment->created_at) }} at {{ formatTime($comment->created_at) }}</span><br>--}}
    {{--                                                    <strong>--}}
    {{--                                                        @foreach($comment->comment_members as $member)--}}

    {{--                                                            <span class="badge badge-dim badge-primary">{{ $member->user->name }}</span>--}}
    {{--                                                        @endforeach--}}
    {{--                                                    </strong>--}}
    {{--                                                </p>--}}
    {{--                                                <p>--}}
    {{--                                                    {{ $comment->description }}--}}
    {{--                                                </p>--}}
    {{--                                                {!!  getFiles($comment->attachment_id) !!}--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}

    {{--                                        <hr>--}}
    {{--                                    @endforeach--}}
    {{--                                </div>--}}
    {{--                            </div><!-- .nk-block -->--}}
    {{--                        </div><!-- Col 12 close -->--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
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
                        {!! Form::hidden('project_id',  $projectDetails->id, ['class' => 'form-control', 'required' => 'required', 'id' => 'project_id']) !!}
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

    {{--  Project Milestone Modal --}}
    <div id="milestoneModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Project Milestone</h5>
        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
        </a>
    </div>

    <div class="modal-body">
        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if( $projectMilestone )
                @foreach( $projectMilestone as $milestone )
                    <tr>
                        <td>{{ $milestone->date }}</td>
                        <td>{{ $milestone->amount }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-primary" href='{{ route("projects.edit", $milestone->id) }}'><em class="icon ni ni-edit"></em></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--  Project Comment Modal --}}
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
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Enter Comment ', 'required' => 'required', 'rows' => 1]) !!}
                    </div>
                </div>
            </div>
            @if(auth()->user()->user_type != 2)
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="form-label" for="fv-topics">Members</label>
                    <div class="form-control-wrap ">
                        {!! Form::select('members[]', getAllMembers(), null, ['class' => 'form-control form-select select2',  'multiple']); !!}
                    </div>
                </div>
            </div>
            @endif
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
                {!! Form::hidden('project_id', $projectDetails->id, ['class' => 'form-control', 'required' => 'required', 'id' => 'comment_project_id']) !!}
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
    @section('scripts')
    <script src="{{ asset('assets/js/apps/messages.js?ver=2.4.0') }}" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
    $('.select2').select2({
             placeholder: function(){
                    $(this).data('placeholder');
                },
             allowClear: true
    });
    });

    $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    // startDate: '-3d'
    endDate: '1d'
    });

    $('.project-datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '1d',
    // endDate: '1d'
    });

    $(document).on('click', '.btn-comment', function(event) {
    $('#comment_project_id').val($(this).attr("data-project-id"))
    });
    </script>

    @endsection
