<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('admin/images/img.jpg') }}" alt="">{{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item"  href="{{ route('profile') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out pull-right"></i> Log Out
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
          </li>

          <li role="presentation" class="nav-item dropdown open">
            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-green" id="unread-notification-chat-count">{{ auth()->user()->unreadNotificationChat->count() + auth()->user()->unreadTransactionNotification->count() }}</span>
            </a>
            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1" id="unread-notification-chat-message">
              @foreach(auth()->user()->unreadTransactionNotification as $notif)
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
            @endforeach
              @foreach (auth()->user()->unreadNotificationChat as $unreadNotificationChat)
                <li class="nav-item">
                  <a class="dropdown-item">
                  <span class="image"><i class="fa fa-bell"></i></span>
                    <span>
                      <span>{{ $unreadNotificationChat->data['from_user_name'] }}</span>
                      <!-- <span class="time">3 mins ago</span> -->
                    </span>
                    <span class="message">
                      {{ $unreadNotificationChat->data['message'] }}
                    </span>
                  </a>
                </li>
              @endforeach

              {{-- <li class="nav-item">
                 <div class="text-center">
                  <a class="dropdown-item">
                    <strong>Hapus semua</strong>
                    <i class="fa fa-trash"></i>
                  </a>
                </div> 
              </li> --}}
              
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
