@extends('layouts.dashboard')

@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="components-preview  mx-auto">
                        <!-- main alert @s -->
                    @include('partials.alerts')
                    <!-- main alert @e -->
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-aside-wrap">
                                    <div class="card-inner card-inner-lg">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabItem17">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Personal Information</h4>
                                                        </div>
                                                        <div class="nk-block-head-content align-self-start d-lg-none"><a
                                                                href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                                data-target="userAside"><em
                                                                    class="icon ni ni-menu-alt-r"></em></a></div>
                                                    </div>
                                                </div>
                                                <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Basics</h6></div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Full Name</span><span
                                                                    class="data-value">{{ $user->name }}</span></div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Role</span><span
                                                                    class="data-value">{{ getRoleName($user->user_type) }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Email</span><span
                                                                    class="data-value">{{ $user->email }}</span></div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Phone Number</span><span
                                                                    class="data-value">{{ $user->phone }}</span></div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Address</span><span
                                                                    class="data-value">{{ $user->address }}</span></div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">CNIC</span><span
                                                                    class="data-value">{{ $user->cnic }}</span></div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Date of Birth</span><span
                                                                    class="data-value">{{ $user->birth_date }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span
                                                                    class="data-label">Joining Date</span><span
                                                                    class="data-value">{{ $user->joining_date }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem18">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Emergency Contact Detail</h4>
                                                        </div>
                                                        <div class="nk-block-head-content align-self-start d-lg-none"><a
                                                                href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                                data-target="userAside"><em
                                                                    class="icon ni ni-menu-alt-r"></em></a></div>
                                                    </div>
                                                </div>
                                                <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Emergency Contact Detail</h6>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span class="data-label">Person</span><span
                                                                    class="data-value">{{ $user->emergency_name }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="data-item">
                                                            <div class="data-col"><span class="data-label">Number</span><span
                                                                    class="data-value">{{ $user->emergency_phone }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <!--                                <div class="tab-pane" id="tabItem20">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Sales Target</h4>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none"><a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a></div>
                                        </div>
                                    </div>
                                    <div class="nk-block">
                                        <div class="nk-data data-list">
                                            <div class="data-head">
                                                <h6 class="overline-title">Sale Targets</h6></div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Individual Target (in USD)</span><span class="data-value">{{ $user->target_individual }}</span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Individual Percentage (in %)</span><span class="data-value">{{ $user->perc_individual }}</span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Team Percentage (in %)</span><span class="data-value">{{ $user->perc_team }}</span></div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col"><span class="data-label">Daily Pitch Target (daily bidding target)</span><span class="data-value">{{ $user->daily_pitch }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->


                                            <div class="tab-pane" id="tabItem19">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Notifications </h4>
                                                        </div>
                                                        <div class="nk-block-head-content">
                                                            <div class="" id="markAllRead"><a href="#">Mark All as
                                                                    Read</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $notifications = auth()->user()->notifications()->get();
                                                @endphp
                                                <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="dropdown-body">
                                                            <div class="nk-notification all-notifications">
                                                                @include('partials.notifications')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tabItem21">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Leaves Status</h4>
                                                        </div>
                                                        <div class="nk-block-head-content align-self-start d-lg-none"><a
                                                                href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                                data-target="userAside"><em
                                                                    class="icon ni ni-menu-alt-r"></em></a></div>
                                                    </div>
                                                </div>
                                                <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="card text-white bg-dark">
                                                                    <div class="card-header">Total Leaves</div>
                                                                    <div class="card-inner">
                                                                        <h5 class="card-title">{{ $user->no_of_leaves }}</h5>
                                                                        <p class="card-text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="card text-white bg-dark">
                                                                    <div class="card-header">Availed</div>
                                                                    <div class="card-inner">
                                                                        <h5 class="card-title">{{ $availed_leaves }}</h5>
                                                                        <p class="card-text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="card text-white bg-dark">
                                                                    <div class="card-header">Available</div>
                                                                    <div class="card-inner">
                                                                        <h5 class="card-title">{{ $available_leaves }}</h5>
                                                                        <p class="card-text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="card text-white bg-dark">
                                                                    <div class="card-header">Applied</div>
                                                                    <div class="card-inner">
                                                                        <h5 class="card-title">{{ $applied_leaves }}</h5>
                                                                        <p class="card-text"></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="components-preview  mx-auto mt-5">

                                                    <div class="nk-block nk-block-lg">
                                                        <div class="card card-preview">
                                                            <div class="card-inner">
                                                                <table class="datatable-init nowrap table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Reason</th>
                                                                        <th>From</th>
                                                                        <th>To</th>
                                                                        <th>No. of Days</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @if( $leaves )
                                                                        @foreach( $leaves as $leave )
                                                                            <tr id="rowID-{{ $leave->id }}">
                                                                                <td>{{ $leave->id }}</td>
                                                                                <td>{{ $leave->reason }}</td>
                                                                                <td>{{ $leave->date_from }}</td>
                                                                                <td>{{ $leave->date_to }}</td>
                                                                                <td>
                                                                                    @if( $leave->no_of_days == 0.5)
                                                                                        Half Day
                                                                                    @else
                                                                                        {{ $leave->no_of_days }} Days
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if( $leave->status == 0)
                                                                                        <span
                                                                                            class="badge badge-dim badge-warning">Pending</span>
                                                                                    @elseif($leave->status == 1)
                                                                                        <span
                                                                                            class="badge badge-dim badge-danger">Not Approved</span>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge badge-dim badge-success">Approved</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>
                                                                                    @if((in_array('update-leave', getUserPermissions())))
                                                                                        <div class="btn-group"
                                                                                             role="group"
                                                                                             aria-label="Basic example">
                                                                                            <a class="btn btn-primary"
                                                                                               href='{{ route("leaves.edit", $leave->id) }}'><em
                                                                                                    class="icon ni ni-edit"></em></a>
                                                                                        </div>
                                                                                    @endif
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
                                    <div
                                        class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg toggle-screen-lg"
                                        data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                        <div class="card-inner-group" data-simplebar="init">
                                            <div class="simplebar-wrapper" style="margin: 0px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper"
                                                             style="height: auto; overflow: hidden;">
                                                            <div class="simplebar-content" style="padding: 0px;">
                                                                <div class="card-inner">
                                                                    <div class="user-card">
                                                                        <div class="user-avatar bg-primary">
                                                                            <span>{!! getUserImage($user->id) !!}</span>
                                                                        </div>
                                                                        <div class="user-info"><span
                                                                                class="lead-text">{!! $user->name !!}</span><span
                                                                                class="sub-text">{!! $user->email !!}</span>
                                                                        </div>
                                                                        <div class="user-action">
                                                                            <div class="dropdown"><a
                                                                                    class="btn btn-icon btn-trigger mr-n2"
                                                                                    data-toggle="dropdown" href="#"><em
                                                                                        class="icon ni ni-more-v"></em></a>
                                                                                <div
                                                                                    class="dropdown-menu dropdown-menu-right">
                                                                                    <ul class="link-list-opt no-bdr">
                                                                                        <li><a href="#"
                                                                                               data-toggle="modal"
                                                                                               data-target="#myModal2"><em
                                                                                                    class="icon ni ni-camera-fill"></em><span>Change Photo</span></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-inner">
                                                                <ul class="nav link-list-menu m-0">
                                                                    <li><a class="active" data-toggle="tab"
                                                                           href="#tabItem17" style="padding: 1rem 0px;"><em
                                                                                class="icon ni ni-user"></em><span>Personal</span></a>
                                                                    </li>
                                                                    <li><a href="#" data-toggle="modal"
                                                                           data-target="#myModal"
                                                                           style="padding: 1rem 0px;"><em
                                                                                class="icon ni ni-shield-star-fill"></em><span
                                                                                style="line-height: 7px;">Password Change<br/><sub>Encrypted & Secure</sub></span></a>
                                                                    </li>
                                                                    <li><a data-toggle="tab" href="#tabItem18"
                                                                           style="padding: 1rem 0px;"><em
                                                                                class="icon ni ni-user-fill-c"></em><span>Emergency Contact</span></a>
                                                                    </li>
                                                                    @if((in_array('read-daily-target', getUserPermissions())))
                                                                        @if(auth()->user()->role != null)
                                                                            @if( auth()->user()->role->name==="sales" || auth()->user()->role->name==="bidder" )
                                                                                <li><a data-toggle="tab" href="#tabItem20"
                                                                                       style="padding: 1rem 0px;"><em
                                                                                            class="icon ni ni-link"></em><span>Sales Target</span></a>
                                                                                </li>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                    <li><a data-toggle="tab" href="#tabItem19"
                                                                           style="padding: 1rem 0px;"><em
                                                                                class="icon ni ni-bell"></em><span>Notifications</span></a>
                                                                    </li>
                                                                    <li><a data-toggle="tab" href="#tabItem21"
                                                                           style="padding: 1rem 0px;"><em
                                                                                class="icon ni ni-bell"></em><span>Leaves Status</span></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder"
                                                 style="width: auto; height: 550px;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- nk-block -->
                </div><!-- .components-preview -->
            </div>
        </div>
    </div>
    </div>


    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="users-frm" class="form-validate is-alter" method="POST"
                      action="{{ route('users.change_password') }}">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group">
                            <label class="form-label" for="full-name">PASSWORD</label>
                            <div class="form-control-wrap">
                                {!! Form::password('password', ['class' => 'form-control validate', 'type' => 'password', 'id' => 'password', 'placeholder' => '', 'maxlength' => 255]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="full-name">CONFIRM PASSWORD</label>
                            <div class="form-control-wrap">
                                {!! Form::password('password_confirmation', ['class' => 'form-control validate', 'type' => 'password', 'id' => 'password-again', 'placeholder' => '', 'maxlength' => 255]) !!}
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

    <!-- sample modal content -->
    <div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Profile Picture</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <!-- Form with validation -->
                <form id="profilepic" class="form-validate is-alter" method="POST"
                      action="{{ route('users.profile_image') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        {!! Form::hidden('_method', old('_method', 'POST')) !!}
                        <div class="form-group">
                            <label class="form-label" for="full-name">Choose Image</label>
                            <div class="form-control-wrap">
                                {!! Form::file('picture', ['class' => 'form-control', 'accept' => 'image/jpg,image/png,image/jpeg,image/tiff,image/webp']) !!}
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
@endsection

@push('scripts')

    <script>
        // $(".deleteBtn").click(function(e){
        //     e.preventDefault();
        //     var id = this.id;
        //     console.log(this.id);
        //     if(confirm("Are you sure you want to delete this?")){
        //         $('#rowID-'+id).remove();
        //     }
        //     else{
        //         return false;
        //     }
        // });
    </script>
@endpush
