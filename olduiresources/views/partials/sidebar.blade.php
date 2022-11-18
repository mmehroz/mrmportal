<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
   <div class="nk-sidebar-element nk-sidebar-head">
{{--    <div class="nk-menu-trigger">--}}
{{--        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em>--}}
{{--        </a>--}}
{{--        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em>--}}
{{--        </a>--}}
{{--    </div>--}}
    <div
    class="nk-sidebar-brand">
            <a href="{{ route("dashboard") }}" class="logo-link">
<!--                <h3 class="">{{ env('APP_NAME') }}</h3>-->
                <img src="{{asset('assets/images/mrm-logo-dark.png')}}" >
            </a>
</div>
</div>
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route("dashboard") }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    @if((in_array('read-project', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Projects</h6>
                    </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Projects</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("projects.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
                                @if((in_array('create-project', getUserPermissions())))
                                    <li class="nk-menu-item">
                                        <a href="{{ route("projects.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                                    </li>
                                @endif
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-order', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Invoices</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Invoices</span>
                        </a>
                        <ul class="nk-menu-sub">
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
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                        @endif
                    @if((in_array('read-brand', getUserPermissions())))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Brands</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("brands.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                             @if((in_array('create-brand', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("brands.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                             @endif
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-services', getUserPermissions())))
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Services</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("services.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            @if((in_array('create-services', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("services.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
                             @endif
                        </ul><!-- .nk-menu-sub -->
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
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Teams</span>
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
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Upwork Unit Bidding</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-daily-target', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("daily_target.indexSales") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Upwork Unit Sales</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-profile', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="{{ route("profiles.index") }}" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Upwork Accounts</span>
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
                        <h6 class="overline-title text-primary-alt">Development Team</h6>
                    </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Daily Progress</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("daily_progress.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
{{--                                @if((in_array('create-daily-progress', getUserPermissions())))--}}
{{--                                    <li class="nk-menu-item">--}}
{{--                                        <a href="{{ route("daily_progress.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>--}}
{{--                                    </li>--}}
{{--                                @endif--}}
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif
                    @if((in_array('read-leave', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Leaves</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Leaves</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("leaves.index") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            @if((in_array('create-leave', getUserPermissions())))
                            <li class="nk-menu-item">
                                <a href="{{ route("leaves.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>
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
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Attendance</span>
                            </a>
                            <ul class="nk-menu-sub">
                            <!--                                <li class="nk-menu-item">
                                <a href="{{ route("add.attendance") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li>-->
                                <li class="nk-menu-item">
                                    <a href="{{ route("show.attendance") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>
                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif

                    @if((in_array(auth()->user()->user_type, [1,3])))
                    @if((in_array('read-user', getUserPermissions())))
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Admin Menu</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">User Management</span>
                        </a>
                        <ul class="nk-menu-sub">
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
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    @endif
                    @endif

                    @if((in_array('chat-access', getUserPermissions())))
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                                <span class="nk-menu-text">Chat Management</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{ route("show.chat") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                                </li>

                            </ul><!-- .nk-menu-sub -->
                        </li><!-- .nk-menu-item -->
                    @endif

                 @if((in_array('read-user', getUserPermissions())))

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-menu-squared"></em></span>
                            <span class="nk-menu-text">Customer Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route("users.customer") }}" class="nk-menu-link"><span class="nk-menu-text">View</span></a>
                            </li>
                            {{-- @if((in_array('create-user', getUserPermissions()))) --}}
                           {{--  <li class="nk-menu-item">
                                <a href="{{ route("users.create") }}" class="nk-menu-link"><span class="nk-menu-text">Add</span></a>
                            </li> --}}
                            {{-- @endif --}}
                        </ul><!-- .nk-menu-sub -->
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
