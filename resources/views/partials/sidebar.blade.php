<style>
.smallDiv {
    width: 100px !important;
}
.dark-mode img.mrm-logo-white {
    display: none;
}

img.mrm-logo-black {
      display: none;
}

.dark-mode img.mrm-logo-black {
    display: block;
}

.nk-sidebar-brand {
    margin-top: 15px;
    margin-bottom: 15px;
}


.modal-body .modal-content {
    border-radius: 20px;
    box-shadow: #0000000F 0px 1px 0px;
}

.form-control {
    width: 100%;
    color: #C7CACE;
    font-size: 16px;
}

.modal-body .form-control::placeholder {color: #C7CACE;}

.modal-footer .btn-primary {
    height: 45px;
    padding-left: 30px;
    padding-right: 30px;
}

.modal-body input.form-control.bidder-datepicker.valid {
    color: #414042;
}

.modal-body .form-icon.form-icon-left {
    color: #000000;
}

 .modal-body .form-label {
    font-size:16px
}

.modal-content {
    border-radius: 20px;
    background: #F6F8FC;
}

.modal-title {
    color: #4D525B;
    font-size: 30px;
    font-weight: 400;
}


option {
    font-size: 16px;
}

form.form-validate button.btn.btn-primary.waves-effect.waves-light {
    color: #fff;
}
</style>



<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
   <div class="nk-sidebar-element nk-sidebar-head">
{{--    <div class="nk-menu-trigger">--}}
{{--        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em>--}}
{{--        </a>--}}
{{--        </a>--}}
{{-- </div>--}}

<a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu" id="sidebarMenu">     <img class ="" src="{{asset('assets/images/svg/3.svg')}}" >  </a>

</div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route("dashboard") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/9.svg')}}" > </span>
                            <span class="nk-menu-text"> &nbsp; Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @if((in_array('read-project', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt"> Projects</h6>
                    </li>
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("projects.index") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/5.svg')}}" ></span>
                                <span class="nk-menu-text"> &nbsp; Projects</span>
                            </a>
                             <!-- <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("projects.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
                                @if((in_array('create-project', getUserPermissions())))
                                    <li class="nk-menu-item">
                                        <a href="{{ route("projects.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                                    </li>
                                @endif
                            </ul>   .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-order', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Invoices</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href= "{{ route("order.index") }}" class="nk-menu-link ">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/1.svg')}}" ></span>
                            <span class="nk-menu-text"> &nbsp; Invoices</span>
                        </a>
                        <!--   <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("order.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li> 
                         @if((in_array('create-order', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("order.create") }}" class="nk-menu-link">
                                    <span class="nk-menu-text">Add</span>
                                </a>
                            </li>
                        @endif
                        </ul>  .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                        @endif
                    @if((in_array('read-brand', getUserPermissions())))
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("brands.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/1.svg')}}" > </span>
                            <span class="nk-menu-text"> &nbsp; Brands</span>
                        </a>
                        <!-- <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("brands.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                             @if((in_array('create-brand', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("brands.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                             @endif
                        </ul> .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-services', getUserPermissions())))
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("services.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon">  <img class ="color-svg" src="{{asset('assets/images/svg/1.svg')}}" >  </span>
                            <span class="nk-menu-text">&nbsp; Services</span>
                        </a>
                        <!-- <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("services.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            @if((in_array('create-services', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("services.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                             @endif
                        </ul> .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                     @endif

                     @if((in_array('read-daily-target', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Sales Team</h6>
                    </li>
                    @endif
                    @if((in_array('read-team', getUserPermissions())))
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("teams.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/4.svg')}}" >   </span>
                            <span class="nk-menu-text">&nbsp; Teams</span>
                        </a>
{{--                        <ul class="nk-menu-sub">--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{ route("teams.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>--}}
{{--                            </li>--}}
{{--                            @if((in_array('create-team', getUserPermissions())))--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{ route("teams.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>--}}
{{--                            </li>--}}
{{--                             @endif--}}
{{--                        </ul><!-- .nk-menu-sub -->--}}
                    </li><!-- .nk-menu-item -->
                     @endif
                    @if((in_array('read-daily-target', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("daily_target.index") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/10.svg')}}" > </span>
                                <span class="nk-menu-text">&nbsp; Upwork Unit Bidding</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-daily-target', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("daily_target.indexSales") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/ico-sale.svg')}}" > </span>
                                <span class="nk-menu-text">&nbsp; Upwork Unit Sales</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    @endif 
                    @if((in_array('read-profile', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("profiles.index") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/7.svg')}}" >  </span>
                                <span class="nk-menu-text">&nbsp; Upwork Accounts</span>
                            </a>
{{--                            <ul class="nk-menu-sub">--}}
{{--                                <li class="nk-menu-item">--}}
{{--                                    <a href="{{ route("profiles.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>--}}
{{--                                </li>--}}
{{--                                @if((in_array('create-profile', getUserPermissions())))--}}
{{--                                    <li class="nk-menu-item">--}}
{{--                                        <a href="{{ route("profiles.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
{{--                            </ul><!-- .nk-menu-sub -->--}}
                        </li><!-- .nk-menu-item -->
                    @endif

                    @if((in_array('read-daily-progress', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt" >Development Team</h6>
                    </li>
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("daily_progress.index") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/ico-progress.svg')}}" > </span>
                                <span class="nk-menu-text"> &nbsp; Daily Progress</span>
                            </a>
                        <!--     <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("daily_progress.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
{{--                                @if((in_array('create-daily-progress', getUserPermissions())))--}}
{{--                                    <li class="nk-menu-item">--}}
{{--                                        <a href="{{ route("daily_progress.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
                            </ul>.nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-leave', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Leaves</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("leaves.index") }}" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/ico-leaves.png')}}" >   </span>
                            <span class="nk-menu-text">Leaves</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("leaves.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            @if((in_array('create-leave', getUserPermissions())))
                            <!-- <li class="nk-menu-item">
                                <a href="{{ route("leaves.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li> -->
                             @endif
                            @if((in_array('summary-leave', getUserPermissions())))
                                <li class="nk-menu-item">
                                    <a href="{{ route("leaves.summary") }}" class="nk-menu-link"><span class="nk-menu-text">Employee Leave Summary</span></a>
                                </li>
                            @endif
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->

                     @endif


                    @if((in_array('read-attendance', getUserPermissions())))
                       <!--   <li class="nk-menu-item has-sub">
                            <a href="{{ route("show.attendance") }}" class="nk-menu-link ">
                                <span class="nk-menu-icon">  <img class ="color-svg" src="{{asset('assets/images/svg/ico-attendance.png')}}" >    </span>
                                <span class="nk-menu-text">Attendance</span>
                            </a>
                              <ul class="nk-menu-sub">
                                                           <li class="nk-menu-item">
                                <a href="{{ route("add.attendance") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                                <li class="nk-menu-item">
                                    <a href="{{ route("show.attendance") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
                            </ul> .nk-menu-sub -->
                        <!--  </li>  .nk-menu-item -->
                    @endif

                    @if((in_array(auth()->user()->user_type, [1,3])))
                    @if((in_array('read-user', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Admin Menu</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("users.index") }}" class="nk-menu-link ">
                            <span class="nk-menu-icon">  <img class ="color-svg" src="{{asset('assets/images/svg/ico-user.svg')}}" >   </span>
                            <span class="nk-menu-text"> &nbsp; User Management</span>
                        </a>
                       <!--  <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("users.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            @if((in_array('create-user', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("users.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                            @endif
                            @if((in_array('read-role', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("roles.index") }}" class="nk-menu-link"><span class="nk-menu-text">View Role</span></a>
                            </li>
                            @endif
                        </ul> .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endif
                    @endif

                    @if((in_array('chat-access', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("show.chat") }}" class="nk-menu-link " style  ="  position: relative; left: -5px;" >
                                <span class="nk-menu-icon">  <img class ="color-svg" src="{{asset('assets/images/svg/ico-chat1.svg')}}" >    </span>
                                <span class="nk-menu-text"> &nbsp; Chat Management</span>
                            </a>
                            <!--   <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("show.chat") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>

                            </ul>.nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif

                 @if((in_array('read-user', getUserPermissions())))

                    <li class="nk-menu-item has-sub">
                        <a href="{{ route("users.customer") }}" class="nk-menu-link ">
                            <span class="nk-menu-icon"> <img class ="color-svg" src="{{asset('assets/images/svg/ico-customer.svg')}}" >   </span>
                            <span class="nk-menu-text">  &nbsp; Customer Management</span>
                        </a>
                        <!-- <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("users.customer") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            {{-- @if((in_array('create-user', getUserPermissions()))) --}}
                           {{--  <li class="nk-menu-item">
                                <a href="{{ route("users.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li> --}}
                            {{-- @endif --}}
                        </ul> .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endif

                   {{--  <li class="nk-menu-item">
                        <a href="{{ route("settings.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Settings</span>
                        </a>
                    </li> --}}
                    <!-- .nk-menu-item -->
                  @if((in_array('view-logs', getUserPermissions())))
                    <li class="nk-menu-item">
                        <a href="{{ route("logs.index") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-alert-circle"></em></span>
                            <span class="nk-menu-text">Logs</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                     @endif
                     <li class="nk-menu-item">
                        <a href="{{ route('clear-cache') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-alert-circle"></em></span>
                            <span class="nk-menu-text">Clear Cache</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
