@foreach($notifications as $notif)
    @if ($notif->type == 'App\Notifications\ChatNotification')
        <li class="nav-item">
            <a class="dropdown-item">
            <span class="image"><i class="fa fa-bell"></i></span>
            <span>
                <span>{{ $notif->data['from_user_name'] }}</span>
                <!-- <span class="time">3 mins ago</span> -->
            </span>
            <span class="message">
                {{ $notif->data['message'] }}
            </span>
            </a>
        </li>
    @else
        <li class="nav-item">
            <a class="dropdown-item" href="{{ $notif->data['next_route'] }}">
            <span class="image"><i class="fa fa-bell"></i></span>
            <span>
                <span>{{ $notif->data['user_name'] }}</span>
                <!-- <span class="time">3 mins ago</span> -->
            </span>
            <span class="message">
                {!! $notif->data['message'] !!}
            </span>
            </a>
        </li>
    @endif
@endforeach