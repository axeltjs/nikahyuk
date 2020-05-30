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
    <div class="col-md-12 col-sm-12">
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
            
            @foreach (auth()->user()->unreadNotifications as $unreadNotifications)
              <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Penawaran!</h4>
                <p>{{ $unreadNotifications->data['message'] }} </p>
                <hr>
                @if (isset($unreadNotifications->data['from']))
                  Klik <a href="{{ $unreadNotifications->data['next_route'] }}">Menuju penawaran</a> untuk melanjutkan
                @endif
              </div>
            @endforeach
        </div>
    </div>
</div>
      
@endsection