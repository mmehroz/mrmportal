{{--<div>--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}

{{--            <div class="col-md-4">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        Users--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <ul class="list-group list-group-flush">--}}
{{--                            @foreach($users as $user)--}}

{{--                                @if($user->id !== auth()->id())--}}
{{--                                    @php--}}
{{--                                        $not_seen= App\Message::where('user_id',$user->id)->where('receiver_id',auth()->id())->where('is_seen',false)->get() ?? null--}}

{{--                                    @endphp--}}

{{--                                    <a wire:click="getUser({{$user->id}})" class="text-dark">--}}
{{--                                        <li class="list-group-item">--}}
{{--                                            <img class="img-fluid avatar" style="width: 50px;height: 50px"--}}
{{--                                                 src="https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png">--}}


{{--                                            @if($user->is_online==true)--}}
{{--                                                <i class="fa fa-circle text-success online-icon">--}}
{{--                                                    @endif--}}

{{--                                                </i> {{$user->name}}--}}
{{--                                                @if(filled($not_seen))--}}
{{--                                                    <div--}}
{{--                                                        class="badge badge-success rounded"> {{ $not_seen->count()}} </div>--}}
{{--                                                @endif--}}
{{--                                        </li>--}}
{{--                                    </a>--}}

{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-md-8">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        @if(isset($sender)) {{$sender->name}}   @endif--}}
{{--                    </div>--}}
{{--                    <div class="card-body message-box" wire:poll="mountdata">--}}
{{--                        @if(filled($allmessages))--}}
{{--                            @foreach($allmessages as $mgs)--}}
{{--                                <div--}}
{{--                                    class="single-message @if($mgs->user_id == auth()->id()) sent @else received @endif">--}}
{{--                                    <p class="font-weight-bolder my-0">{{$mgs->user->name}}</p>--}}
{{--                                    {{ $mgs->message}}--}}
{{--                                    <br><small class="text-muted w-100">Sent <em>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($mgs->created_at))->diffForHumans()}}</em></small>--}}
{{--                                </div>--}}

{{--                            @endforeach--}}
{{--                        @endif--}}

{{--                    </div>--}}

{{--                    <div class="card-footer">--}}
{{--                        <form wire:submit.prevent="SendMessage">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-8">--}}
{{--                                    <input wire:model="message"--}}
{{--                                           class="form-control input shadow-none w-100 d-inline-block"--}}
{{--                                           placeholder="Type a message" required>--}}
{{--                                </div>--}}

{{--                                <div class="col-md-4">--}}
{{--                                    <button type="submit" class="btn btn-primary d-inline-block w-100"><i--}}
{{--                                            class="far fa-paper-plane"></i> Send--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}












<div class="nk-chat">
    <div class="nk-chat-aside">
        <div class="nk-chat-aside-head">
            <div class="nk-chat-aside-user">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" aria-expanded="false">
                        <div class="chat-media user-avatar bg-purple">
                            {!! getUserImage(auth()->user()->id) !!}
                        </div>
                        <div class="title">Chats</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="nk-chat-aside-body" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="nk-chat-list">
                                    <h6 class="title overline-title-alt">User Listing</h6>
                                    <ul class="chat-list">
                                        @foreach($users as $user)
                                            <li class="chat-item">
                                            @if($user->id !== auth()->id())
                                                @php
                                                    $not_seen= App\Message::where('user_id',$user->id)->where('receiver_id',auth()->id())->where('is_seen',false)->get() ?? null

                                                @endphp
                                                <a wire:click="getUser({{$user->id}})" class="chat-link text-dark {{ ($not_seen->count() > 0) ? "is-unread" : "chat-open"}}" href="#">
                                                    <div class="chat-media user-avatar bg-purple">
                                                        {!! getUserImage($user->id) !!}
                                                    </div>
                                                    <div class="chat-info">
                                                        <div class="chat-from">
                                                            <div class="name">{{$user->name}} {!! ($not_seen->count() > 0) ? "<span class='badge badge-pill badge-primary'> ". $not_seen->count() ."</span>" : "" !!}</div>
                                                            <span class="time">
                                                                @if(isset($user))
                                                                    @if(Cache::has('user-is-online-' . $user->id))
                                                                        <span class="badge badge-dot badge-dot-xs badge-success">Online</span>
                                                                    @else
                                                                        {{ \Carbon\Carbon::createFromTimeStamp(strtotime($user->last_seen))->diffForHumans()}}
                                                                    @endif
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 656px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 252px; display: block; transform: translate3d(0px, 62px, 0px);"></div>
            </div>
        </div>
    </div>
    <div class="nk-chat-body ">
        <div class="nk-chat-head">
            <ul class="nk-chat-head-info">
                <li class="nk-chat-body-close"><a href="#" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a></li>
                <li class="nk-chat-head-user">
                    <div class="user-card">
                        @if(isset($sender))
                            <div class="user-avatar bg-purple">
                                {!! getUserImage($sender->id) !!}
                            </div>
                        @endif
                        <div class="user-info">
                            <div class="lead-text">@if(isset($sender)) {{$sender->name}}   @endif</div>
                            <div class="sub-text">
                                <span class="d-none d-sm-inline mr-1">
                                    @if(isset($sender))
                                        @if(Cache::has('user-is-online-' . $sender->id))
                                            <span class="badge badge-dot badge-dot-xs badge-success">Online</span>
                                        @else
                                            {{ \Carbon\Carbon::createFromTimeStamp(strtotime($sender->last_seen))->diffForHumans()}}
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
          {{--   <ul class="nk-chat-head-tools">
                <li class="mr-n1 mr-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle active"><em class="icon ni ni-alert-circle-fill"></em></a></li>
            </ul> --}}
         {{--    <div class="nk-chat-head-search">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div>
                        <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="nk-chat-panel" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: -20px -28px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content card-body message-box" wire:poll="mountdata" style="padding: 20px 28px;">
                                @if(filled($allmessages))
                                    @foreach($allmessages->groupBy(function($item) {
                                    return $item->created_at->format('d-M-Y');
                                    }) as $data => $messages)
                                        <div class="chat-sap">
                                            <div class="chat-sap-meta"><span>{{ $data }}</span></div>
                                        </div>
                                        @foreach($messages as $mgs)
                                            @if($mgs->user_id == auth()->id())
                                                <div class="chat is-me">
                                                    <div class="chat-content">
                                                        <div class="chat-bubbles">
                                                            <div class="chat-bubble">
                                                                <div class="chat-msg"> {{ $mgs->message}} </div>
                                                            </div>
                                                        </div>
                                                        <ul class="chat-meta">
                                                            <li>{{$mgs->user->name}}</li>
                                                            <li>{{ $mgs->created_at->format('d M, Y h:i A') }}</li>
                                                        </ul>
                                                    </div>
                                                    <div class="chat-avatar">
                                                        <div class="chat-media user-avatar bg-purple">
                                                            {!! getUserImage($mgs->user->id) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="chat is-you">
                                                    <div class="chat-avatar">
                                                        <div class="chat-media user-avatar bg-purple">
                                                            {!! getUserImage($mgs->user->id) !!}
                                                        </div>
                                                    </div>
                                                    <div class="chat-content">
                                                        <div class="chat-bubbles">
                                                            <div class="chat-bubble">
                                                                <div class="chat-msg"> {{ $mgs->message}} </div>
                                                            </div>
                                                        </div>
                                                        <ul class="chat-meta">
                                                            <li>{{$mgs->user->name}}</li>
                                                            <li>{{ $mgs->created_at->format('d M, Y h:i A') }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 769px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 149px; transform: translate3d(0px, 60px, 0px); display: block;"></div>
            </div>
        </div>
        <form wire:submit.prevent="SendMessage">
            <div class="nk-chat-editor">
                <div class="nk-chat-editor-form">
                    <div class="form-control-wrap">
                        <textarea wire:model="message" class="form-control form-control-simple no-resize" rows="1" id="messageBox" placeholder="Type your message..."></textarea>
                    </div>
                </div>
                <ul class="nk-chat-editor-tools g-2">
                    <li>
                        <button class="btn btn-round btn-primary btn-icon" id="sendMessageBtn"><em class="icon ni ni-send-alt"></em></button>
                    </li>
                </ul>
            </div>
        </form>
        {{-- <div class="nk-chat-profile visible" data-simplebar="init">
            <div class="simplebar-wrapper" style="margin: 0px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" style="padding: 0px;">
                                <div class="user-card user-card-s2 my-4">
                                    @if(isset($sender))
                                    <div class="user-avatar md bg-purple">
                                        {!! getUserImage($sender->id) !!}
                                    </div>
                                    <div class="user-info">
                                        <h5 class="m-t-5"> {{ $sender->name }} </h5>
                                        <span class="sub-text">
                                            @if(Cache::has('user-is-online-' . $sender->id))
                                                <span class="badge badge-dot badge-dot-xs badge-success">Online</span>
                                            @else
                                                Active {{ \Carbon\Carbon::createFromTimeStamp(strtotime($sender->last_seen))->diffForHumans()}}
                                            @endif
                                        </span>
                                    </div>
                                    @endif
                                    <div class="user-card-menu dropdown"><a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Profile</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simplebar-placeholder" style="width: auto; height: 756px;"></div>
            </div>
            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
            </div>
            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                <div class="simplebar-scrollbar" style="height: 307px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
            </div>
        </div> --}}
    </div>
</div>