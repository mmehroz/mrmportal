<style>
 .dropdown-foot.center {
    justify-content: space-between !important; 
    background:#F9F9F9;   
   }
   .dropdown-head span.sub-title.nk-dropdown-title {
    font-size: 22px !important;
    color: #000000;
}

.dropdown-menu-s1 {
    border-top: unset;
    border: 1px solid #C7CACE;
}

.nk-notification-text {
    color:#4D525B !important;
    font-size:14px;
}

.nk-notification-item {
    padding:5px 1.75rem !important;
    background:#fff !important;
    border:unset !important;
}

.dropdown-head {
    border-bottom: unset !important;
}

.dropdown-foot {
    border-top: unset !important;
}

.dropdown-body {
    border: unset !important;
}

.nk-notification {
    padding: 15px 0px;
}

.nk-notification-time {
    font-size: 12px;
    color: #FF5D76;
}

.nk-notification-icon {
    margin-top: -38px;
    margin-right: 17px;
}
.dot-gray{
    color:#fff;
}

.nk-quick-nav .dropdown-menu {
    border: 1px solid #C7CACE;
    border-radius: 5px;
    box-shadow: #00000029 0px 0px 6px;
}

.nk-notification {
    border: 0px solid #ffff;
}

.nk-notification-text {
    line-height: 18px;
}


.dot-success {
    display: none;
}

.icon-status-info:after {
    display: none;
}

a.dropdown-item span {
    color: #FF5D76;
    margin-left: 10px;
}

img.mrm-logo-white
{
    transition: all 0.38s ease;
}

@media only screen and (max-width:600px) {
img.mrm-logo-white {
    position: unset;
    margin-left: 0px;
}
}

a.dark-switch {
    display: block !important;
}




.dark-mode .hide-dark {
    display: none;
}

.hide-lght {
    display: none;
}


.dark-mode  .hide-lght {
    display:block;
    transition: all 0.38s ease;
}

img.mrm-logo-white.hide-dark {
    transition: all 0.38s ease;
}

.nk-sidebar-element.nk-sidebar-head
{
    width:50%;
}


.dark-mode img.mrm-logo-white {
    display: block;
}


.dark-mode .mrm-black {
    display: none !important;
}

.dark-mode .nk-sidebar-head {
    background-color: #414042 !important;
}

.dark-mode .nk-content {
    background: #1B1A1C !important;
}

</style>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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
            <div class="nk-sidebar-brand">
    <img class ="mrm-logo-white mrm-black" src="{{asset('assets/images/[LOGO].png')}}" >
    <img class ="mrm-logo-white mrm-logo-black"  src="{{asset('assets/images/mrm-logo-dark.png')}}" >
    <a href="{{ route("dashboard") }}" class="logo-link">
<!--                <h3 class="">{{ env('APP_NAME') }}</h3>-->
               
            </a>
</div>

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
                            <img class ="svg-color" src="{{asset('assets/images/svg/ico-chat.svg')}}" >
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

                        <i class="fas fa-bell" style ="color:#4D525B"></i>  
                        </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1" style="">
                            <div class="dropdown-head" id="markAllRead"><span class="sub-title nk-dropdown-title">Notifications</span></div>
                            <div class="dropdown-body">
                                <div class="nk-notification">

                      @include('partials.notifications')
                             </div>
                             </div>
                            <div class="dropdown-foot center"> <a href="javascript:void(0)">Mark All as Read</a> <a href="{{ route('users.profile') }}#tabItem19">View All</a></div>
                        </div>
                    </li>
                     {{-- </div> --}}
                    <li class="dropdown notification-dropdown mr-n1" style="display: none;">
                        <a href="{{ route("order.index") }}" class="nk-quick-nav-icon" aria-expanded="false">
                        <div class="icon-status icon-status-info"><i class="fas fa-bell"></i>  <em class="icon ni ni-bell"></em></div>
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
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 toggle-set ">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                         {!! getUserImage(auth()->user()->id) !!}
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ ucfirst(auth::user()->name) }}</span>
                                        <!-- <span class="sub-text">{{ auth()->user()->email }}</span> -->
                                        <a href="{{ route('users.profile') }}"><span>View Profile</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                              
                                    <li><a class="dark-switch" href="javascript:void(0)"><em class="icon ni ni-moon" style ="color:#414042"></em><span style ="color:#FF5D76"> &nbsp; Dark Mode</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <img class ="svg-color" src="{{asset('assets/images/svg/ico.svg')}}" > &nbsp; <span>Sign out</span>
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
