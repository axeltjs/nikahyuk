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
                        <p class="h5 mb-0 py-1">Daftar Vendor</p>
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

                            @if(isset($chatItems))
                                @foreach ($chatItems as $chatItem)
                                    <a href="#" class="list-group-item list-group-item-action list-group-item-chat list-group-item-light rounded-0" data-id="{{ $chatItem->id }}">
                                        <div class="media">
                                            <img src="{{ $chatItem->vendor->photo_format_url }}" alt="user" width="50" class="rounded-circle">
                                            <div class="media-body ml-4">
                                                <div class="d-flex align-items-center justify-content-between mb-1">
                                                    <h6 class="mb-0">{{ $chatItem->vendor->company->name }}</h6>
                                                    <input type="hidden" id="chatbox-vendor-id" value="{{ $chatItem->vendor->id }}">
                                                    <small class="small font-weight-bold">
                                                        {!! $chatItem->vendor->company->overall_score !!}
                                                    </small>
                                                    <!-- <small >14 Dec</small> -->
                                                </div>
                                                <p class="font-italic text-muted mb-0 text-small">{{ $chatItem->vendor->name }}</p> 
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Box-->
            <div class="col-7 px-0">
                <div class="px-4 py-5 chat-box bg-white" id="chat-box">
                    <p style="text-align: center;">Pilih vendor di kotak sebelah kiri ya..</p>
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
                        <input type="text" placeholder="Type a message" aria-describedby="button-send-message" class="text-chat form-control rounded-0 border-0 py-4 bg-light" id="form-typing-message">
                        <div class="input-group-append">
                            <button id="button-rate-vendor" type="button" class="btn btn-chat btn-rate" data-show="tip" title="Beri ulasan vendor ini" style="color:#f1c40f"> <i class="fa fa-star"></i></button>
                            <button id="button-select-vendor" type="button" class="btn btn-chat btn-select" data-show="tip" title="Pilih vendor ini"> <i class="fa fa-check-circle"></i></button>
                            <button id="button-send-message" type="button" class="btn btn-chat btn-link"> <i class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
    <form action="{{ route('customer.deal') }}" method="post">
        {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5>Apakah anda yakin memilih Vendor ini?</h5>
          <input type="hidden" name="vendor_id" class="confirm-vendor-id">
          <br>
          <small>Harga kesepakatan:</small>
          <input type="number" name="amount" class="form-control" placeholder="Masukkan harga kesepakan (Rp)" required>
          <br>
          <small>Metode pembayaran:</small>
          {!! Form::select('payment_method', ['cash' => 'cash (DP 30%)', '2' => 'cicilan 2x (DP 10%, 40%, 50%)', '3' => 'cicilan 3x (DP 5%, 15%, 50%, 30%)'], old('payment_method'), ['class' => 'form-control', 'placeholder' => 'Pilih metode pembayaran', 'required']) !!}
          <br>
          <small>Paket yang dipilih:</small>
          <select name="quotation_id" class="form-control" id="quotation_id" placeholder="Pilih Penawaran yang sesuai" required></select>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <!-- Modal -->
<div id="rateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
    <form action="{{ route('customer.rate.vendor') }}" method="post">
        {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <h5>Berikan ulasanmu terhadap vendor ini!</h5>
          <input type="hidden" name="vendor_id" class="confirm-vendor-id">
          <br>
          <p>Tulis ulasanmu:</p>
          <textarea type="text" name="review" class="form-control" placeholder="Tulis ulasanmu" required></textarea>
          <br>
          <p>Nilai:</p>
          <p class="ratings" style="font-size: 25px">
            <a onclick="setNilai(1)"><span id="score-star1" class="fa fa-star-o"></span></a>
            <a onclick="setNilai(2)"><span id="score-star2" class="fa fa-star-o"></span></a>
            <a onclick="setNilai(3)"><span id="score-star3" class="fa fa-star-o"></span></a>
            <a onclick="setNilai(4)"><span id="score-star4" class="fa fa-star-o"></span></a>
            <a onclick="setNilai(5)"><span id="score-star5" class="fa fa-star-o"></span></a>
          </p>
          <input type="hidden" name="score" id="score">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
  </div>

@endsection

@section('js')
<script>
  
        const socket = io('https://socket.nikahyuk.online').set('origins','*:*');

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

        $('#button-select-vendor').on('click', function (e) {
            e.preventDefault();

            $('#confirmModal').modal('show');
        });

        $('#button-rate-vendor').on('click', function (e) {
            e.preventDefault();

            $('#rateModal').modal('show');
        });

        let setNilai = (nilai) => {
            $('#score').val(nilai);
            for (let index = 1; index <= nilai; index++) {
                $('#score-star' + index).addClass('fa-star').removeClass('fa-star-o');
                
                // sisa
                if(index == nilai){
                    for(let idx = nilai + 1; idx <= 5; idx++){
                        $('#score-star' + idx).addClass('fa-star-o').removeClass('fa-star');
                    }
                }
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
                url: '{{ route("customer.chat.send-message") }}',
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

            console.log(id);
            console.log(el);
            $('.list-group-item-action').addClass('list-group-item-light list-group-item-chat');
            el.removeClass('list-group-item-light list-group-item-chat').addClass('active text-white');

            $('#chat-box').empty();
            $('#quotation_id').empty();
            $('#form-typing-message').val('');
            $('.confirm-vendor-id').val('');
            $('.btn-select').prop('disabled', false);
            $('.btn-rate').prop('disabled', true);

            if (id) {
                $.ajax({
                    url: '{{ route("customer.chat.get-all-message") }}',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#chat-box').html(
                            response.data_view
                        );
                        if(response.transaksi){
                            $('.btn-select').prop('disabled', true);
                            $('.btn-rate').prop('disabled', false);
                        }

                        $.each(response.penawaran, function(id, name){
                            $('#quotation_id').append('<option value="'+id+'">'+name+'</option>');
                        });
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