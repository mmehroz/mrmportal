<div class="nk-header nk-header-fixed is-light  d-print-none">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
               {{--  <a href="{{ route("dashboard") }}" class="logo-link">
                    <img class="logo-light logo-img" src="{{ asset(session()->get('system_settings.logo_header')) }}" srcset="{{ asset(session()->get('system_settings.logo_header')) }}" alt="logo">
                    <img class="logo-dark logo-img" src="{{ asset(session()->get('system_settings.logo_header')) }}" srcset="{{ asset(session()->get('system_settings.logo_header')) }}" alt="logo-dark">
                </a> --}}
            </div><!-- .nk-header-brand -->
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu" id="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            <div class="nk-header-news d-none d-xl-block">
                <div class="nk-news-list">
                    @if(session('impersonated_by'))
                        <a class="btn btn-info" href='{{ route("user.leave.impersonate") }}'>Back to Admin</a>
                    @endif
{{--                    <a class="nk-news-item" href="#">--}}
{{--                        <div class="nk-news-icon">--}}
{{--                            <em class="icon ni ni-card-view"></em>--}}
{{--                        </div>--}}
{{--                        <div class="nk-news-text">--}}
{{--                            <p>Do you know the latest update of 2019? <span> A overview of our is now available on YouTube</span></p>--}}
{{--                            <em class="icon ni ni-external"></em>--}}
{{--                        </div>--}}
{{--                    </a>--}}
                </div>
            </div><!-- .nk-header-news -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    @if((in_array('chat-access', getUserPermissions())))
                    <li class="dropdown notification-dropdown mr-n1" id="notifyIcon">
                        <a href="{{ route('show.chat') }}" class="nk-quick-nav-icon" title="Go to Chat">
                        <div class="">
                            <div class="{{ hasUnreadMessages() ? 'icon-status icon-status-info' : ''}}">
                                <em class="icon ni ni-chat-circle-fill"></em>
                            </div>
                        </div>
                        </a>
                    </li>
                    @endif
                    @php
                       $notifications = auth()->user()->notifications()->take(10)->get();
                     @endphp
                     {{-- <div id="notifications">   --}}
                     <li class="dropdown notification-dropdown mr-n1" id="notifyIcon">
                         @if(auth()->user()->unreadNotifications->count() > 0)
                            <span style="border-color: #e85347; background: #e85347; height: 25px; width: 25px; text-align: center; border-radius: 50px; color: #fff;"> {!! auth()->user()->unreadNotifications->count() !!} </span>
                         @endif
                         <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown" aria-expanded="false">
                        <div class="">
                            <em class="icon ni ni-bell"></em>
                        </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1" style="">
                            <div class="dropdown-head" id="markAllRead"><span class="sub-title nk-dropdown-title">Notifications</span><a href="javascript:void(0)">Mark All as Read</a></div>
                            <div class="dropdown-body">
                                <div class="nk-notification">

                      @include('partials.notifications')
                             </div>
                             </div>
                            <div class="dropdown-foot center"><a href="{{ route('users.profile') }}#tabItem19">View All</a></div>
                        </div>
                    </li>
                     {{-- </div> --}}
                    <li class="dropdown notification-dropdown mr-n1" style="display: none;">
                        <a href="{{ route("order.index") }}" class="nk-quick-nav-icon" aria-expanded="false">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                        </a>
                    </li>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar">
                                       {!! getUserImage(auth()->user()->id) !!}
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status dropdown-indicator">{{ ucfirst(auth()->user()->name) }}</div>
{{--                                    <div class="user-name">{{ auth()->user()->name }}</div>--}}
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                         {!! getUserImage(auth()->user()->id) !!}
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ ucfirst(auth::user()->name) }}</span>
                                        <span class="sub-text">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{ route('users.profile') }}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                    <li><a class="dark-switch" href="javascript:void(0)"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <em class="icon ni ni-signout"></em><span>Sign out</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->

                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
