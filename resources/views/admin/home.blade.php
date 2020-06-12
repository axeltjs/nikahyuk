@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left" style="width:100%;">
      @hasrole('Customer')
      <h1>Halo calon pengantin yang berbahagia!</h1>
      @endhasrole
      
      @hasrole('Vendor')
      <h1>Selamat datang!</h1>
      @endhasrole
    </div>
</div>
<div class="clearfix"></div>
<br>
<br>
<div class="row">
  <div class="col-md-8 col-sm-6 col-xs-12">
    <div class="x_panel">
      <hr>
      <div class="x_content">
        <ul class="list-unstyled timeline">
          @foreach (auth()->user()->unreadNotificationOffer as $unreadNotifications)
          <li>
            <div class="block">
              <div class="tags">
                <a href="" class="tag">
                  <span>Notifikasi!</span>
                </a>
              </div>
              <div class="block_content">
                <div class="byline">
                  <span>{{ $unreadNotifications->created_at->diffForHumans() }}</span>
                </div>
                {{ $unreadNotifications->data['message'] }}
                <br>
                @if (isset($unreadNotifications->data['from']))
                  @if ($unreadNotifications->data['from'] == 'vendor')
                    Klik <a style="color: red" href="{{ $unreadNotifications->data['next_route'] }}">Menuju chat</a> untuk melanjutkan
                  @elseif ($unreadNotifications->data['from'] == 'customer')
                    Klik <a style="color: red" href="{{ $unreadNotifications->data['next_route'] }}">Menuju penawaran</a> untuk melanjutkan
                  @endif
                @endif
                </p>
              </div>
            </div>
          </li>
          @endforeach
        </ul>

      </div>
    </div>
  </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="x_content">
            <div class="bs-example-popovers mb-4">
                @isset($has_survey)
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading"><i class="fa fa-thumbs-up"></i></h4>
                    <p>Survey kamu sudah kami rekam, kamu akan diberikan notifikasi apabila ada vendor yang cocok dengan survey kamu!
                        <br>Terima kasih telah memilih Nikahyuk sebagai partner acara pernikahanmu!</p>
                  </div>
                @endisset
            </div>
        </div>
    </div>

</div>
      
@endsection