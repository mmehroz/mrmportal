        @foreach ($notifications as $notification)
           <a href="{{ $notification->data['link'] }}" class="markRead">
                <div class="nk-notification-item dropdown-inner @empty($notification->read_at) bg-light @endempty">
            {{-- <div class="nk-notification-icon"><span class="icon icon-circle bg-primary">{{ getNameInitials($notification->data['user_name']) }}</span></div> --}}
            <div class="nk-notification-icon"><span class="user-avatar icon icon-circle bg-primary">{!! getUserImage($notification->data['user_id']) !!}</span></div>
            <div class="nk-notification-content">
                <div class="nk-notification-text @empty($notification->read_at)  @endempty">{{ $notification->data['description'] }}</div>
                <div class="nk-notification-time">{{ getNotifyTime($notification->created_at ) }}</div>
                <span class="notifyId" hidden="">{{ $notification->id }}</span>
            </div>
            </div>
           </a> 
        @endforeach