
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Nikahyuk') }}</title>
    <link rel="icon" href="{{ asset('img/icon.png') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="{{ asset('admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
    <!-- Notif -->
    <link href="{{ asset('admin/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    
    <style>
      .ui-pnotify-icon .glyphicon{
        margin-top: 6px;
      }

      .btn-xs{
            max-width: 100px;
            max-height: 23px;
            padding: 2px;
            font-size: 11px;
        }

        .label {
          padding:7px;
          border-radius: 5px;
          margin: 0;
        }

        .label-danger{
          background:#e74c3c;
          color:#fff;
        }

        .label-success{
          background:#27ae60;
          color:#fff;
        }

        .label-info{
          background:#0abde3;
          color:#fff;
        }

        .label-primary{
          background:#0984e3;
          color:#fff;
        }

        .btn-chat{
          margin-top: 12px;
          font-size: 25px;
        }

        .text-chat{
          margin-top:10px;
        }

        .btn-select{
          color: #27ae60;
        }

        .btn-select:hover{
          color: #1a7a43;
        }
    </style>
    
    @yield('css')

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img style="width:160px; margin-left:20px; height:auto;" src="{{ asset('img/nikahyuk-logo.png') }}" alt="logo"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ Auth::user()->photo_format_url }}" alt="..." style="width: 70px; height:70px;" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('admin.layouts.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('admin.layouts.top')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')

        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-left">Crafted with <i class="fa fa-heart"></i> Axel Saputra 2020</div>
          <div class="pull-right">
             Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Notif -->
    <script src="{{ asset('admin/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('admin/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('admin/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('admin/vendors/nprogress/nprogress.js') }}"></script>
    <!-- jQuery custom content scroller -->
    <script src="{{ asset('admin/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('admin/build/js/custom.min.js') }}"></script>
    <script src="{{ asset('js/laravel.js') }}"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>

    @yield('js')
    
    @if($errors->isNotEmpty())
        <script>
            $(document).ready(function(){
                new PNotify({
                    title: 'Error',
                    text: '@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach',
                    type: 'error',
                    hide: false,
                    styling: 'bootstrap3'
                });
            });
        </script>
    @endif
    @if (session()->has('flash_notification.message'))
      <script>
          $(document).ready(function(){
              new PNotify({
                  title: '{{ ucfirst(session()->get("flash_notification.level")) }}',
                  text: '{!! session()->get("flash_notification.message") !!}',
                  type: '{{ session()->get("flash_notification.level") }}',
                  hide: true,
                  styling: 'bootstrap3'
              });
          });
      </script>
    @endif

    <script>
        const socketChat = io('https://socket.nikahyuk.online').origins("*:*");
        socketChat.on('receive-chat-notif', function (item) {
            if (item.user_id == "{{ auth()->user()->id }}") {
                $.ajax({
                  url: '{{ route("chat.unread-notification") }}',
                  type: 'GET',
                  data: {},
                  success: function (response) {
                    if (response.status) {
                      $('#unread-notification-chat-count').html(response.data_view_count);
                      $('#unread-notification-chat-message').html(response.data_view_message);
                    }
                  }
                });
            }
        });
    </script>
  </body>
</html>