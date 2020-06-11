@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3 class="title">Chat </h3>
        </div>
    </div>
    <div class="container py-5 px-4">
        <div class="row rounded-lg overflow-hidden shadow">
            <!-- Users box-->
            <div class="col-5 px-0">
                <div class="bg-white">

                    <div class="bg-gray px-4 py-2 bg-light">
                        <p class="h5 mb-0 py-1">Daftar Customer</p>
                    </div>

                    <div class="messages-box">
    
                        <div class="list-group rounded-0">

                            <!-- <a class="list-group-item list-group-item-action active text-white rounded-0">
                                <div class="media"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                    <div class="media-body ml-4">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="mb-0">Jason Doe</h6><small class="small font-weight-bold">25 Dec</small>
                                    </div>
                                    <p class="font-italic mb-0 text-small">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                                    </div>
                                </div>
                            </a> -->

                            @foreach ($chatItems as $chatItem)
                                <a href="#" class="list-group-item list-group-item-action list-group-item-chat list-group-item-light rounded-0" data-id="{{ $chatItem->id }}">
                                    <div class="media">
                                        <img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                                        <div class="media-body ml-4">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <h6 class="mb-0">{{ $chatItem->customer->name }}</h6>
                                                <!-- <small class="small font-weight-bold">14 Dec</small> -->
                                            </div>
                                            <!-- <p class="font-italic text-muted mb-0 text-small">Lorem ipsum dolor sit amet, consectetur. incididunt ut labore.</p> -->
                                        </div>
                                    </div>
                                </a>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!-- Chat Box-->
            <div class="col-7 px-0">
                <div class="px-4 py-5 chat-box bg-white" id="chat-box">
                    <p style="text-align: center;">Pilih lawan bicaramu di kotak sebelah kiri ya..</p>
                    <!-- Sender Message-->
                    <!-- <div class="media w-50 mb-3"><img src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user" width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                            <p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div> -->

                    <!-- Reciever Message-->
                    <!-- <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                            <p class="text-small mb-0 text-white">Test which is a new approach to have all solutions</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div> -->

                </div>

                <!-- Typing area -->
                <form action="#" class="bg-light d-none" id="form-typing">
                    <div class="input-group">
                        <input type="text" placeholder="Type a message" aria-describedby="button-send-message" class="form-control text-chat rounded-0 border-0 py-4 bg-light" id="form-typing-message">
                        <div class="input-group-append">
                            <button id="button-send-message" type="button" class="btn btn-chat btn-link"> <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const socket = io('http://localhost:3000');

        socket.on('receive-message', function (item) {
            if (item.user_id == "{{ $user_id }}") {

                var chat_box_active = $('body .list-group-item-action.active').first();
                if (chat_box_active.length > 0) {
                    var chat_box_active_id = chat_box_active.data('id');

                    if (chat_box_active_id == item.chat_id) {
                        $('#chat-box').append(
                            item.data_view
                        );

                        scrollChatBox();
                    }
                }
            }
        });

        function scrollChatBox() {
            var objDiv = document.getElementById("chat-box");
            objDiv.scrollTop = objDiv.scrollHeight;
        }

        function formTypingToggle(show = 1) {
            if (show) {
                if (show == 1) {
                    $('#form-typing').removeClass('d-none');
                } else {
                    $('#form-typing').addClass('d-none');
                }
            } else {
                $('#form-typing').toggleClass('d-none');
            }
        }

        $('#button-send-message').on('click', function (e) {
            e.preventDefault();

            var el = $(this);

            el.attr('disabled', 'disabled');

            var message = $('#form-typing-message').val();

            var chat_active = $('body .list-group-item-action.active').first();
            var id = chat_active.data('id');

            $.ajax({
                url: '{{ route("vendor.chat.send-message") }}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    message: message
                },
                success: function (response) {
                    if (response.data.status) {
                        $('#chat-box').append(
                            response.data_view
                        );

                        scrollChatBox();

                        $('#form-typing-message').val('');

                        socket.emit('send-message', {
                            user_id: response.data.user_id,
                            chat_id: response.data.chat_id,
                            data_view: response.data_receive_view
                        });

                        socket.emit('send-chat-notif', {
                            user_id: response.data.user_id,
                            chat_id: response.data.chat_id,
                        });

                    } else {
                        alert('Terjadi Kesalahan Request');
                    }
                   
                    el.removeAttr('disabled');
                },
                error: function () {
                    el.removeAttr('disabled');
                    alert('Terjadi Kesalahan Request');
                }
            });
        });

        $('body').on('click', '.list-group-item-chat', function (e) {
   
            e.preventDefault();

            var el = $(this);
            var id = el.data('id');

            $('.list-group-item-action').addClass('list-group-item-light list-group-item-chat');
            el.removeClass('list-group-item-light list-group-item-chat').addClass('active text-white');

            $('#chat-box').empty();
            $('#form-typing-message').val('');

            if (id) {
                $.ajax({
                    url: '{{ route("vendor.chat.get-all-message") }}',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#chat-box').html(
                            response.data_view
                        );

                        scrollChatBox();

                        formTypingToggle(1);
                    },
                    error: function () {
                        formTypingToggle(1);
                        alert('Terjadi Kesalahan Request');
                    }
                });
            } else {
                formTypingToggle(1);
            }
        });

    </script>
@endsection