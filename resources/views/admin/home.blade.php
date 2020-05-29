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
        <div class="x_content bs-example-popovers">
              @isset($has_survey)
                {{-- @if($has_survey->submited) --}}
                  <span class="alert alert-success col-sm-12" style="width:100%;" role="alert"> <h2><i class="fa fa-thumbs-up"></i></h2> Survey kamu sudah kami rekam, kamu akan diberikan notifikasi apabila ada vendor yang cocok dengan survey kamu!<br>Terima kasih telah memilih Nikahyuk sebagai partner acara pernikahanmu!</span>
                {{-- @else  --}}
                  {{-- <span class="alert alert-warning col-sm-12" style="width:100%;" role="alert"> <i class="fa fa-exclamation-triangle"></i> Kamu belum melakukan survey, ayo <a style="color:#fff; text-decoration:underline;" href="{{ route('customer.survey') }}">survey sekarang!</a></span> --}}
                {{-- @endif --}}
            @endisset


            @foreach (auth()->user()->unreadNotifications as $unreadNotifications)
              <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Penawaran!</h4>
                <p>Anda mendapatkan penawaran dari client {{ $unreadNotifications->data['user_name'] ?? '-' }}</p>
                <hr>
                Klik <a href="{{ route('quotation.index') }}">Menuju penawaran</a> untuk melanjutkan
              </div>
            @endforeach
        </div>
    </div>
</div>
      
@endsection