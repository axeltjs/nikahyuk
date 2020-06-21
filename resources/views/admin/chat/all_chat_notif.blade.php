@foreach ($notifications as $notification)
    <li class="nav-item">
        <a class="dropdown-item">
            <span class="image"><img src="{{ $notification->data['photo_profile'] ?? null }}" alt="Profile Image" /></span>
            <span>
                <span>{{ $notification->data['from_user_name'] }}</span>
                <!-- <span class="time">3 mins ago</span> -->
            </span>
            <span class="message">
                {{ $notification->data['message'] }}
            </span>
        </a>
    </li>
@endforeach