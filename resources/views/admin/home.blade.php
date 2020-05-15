@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left" style="width:100%;">
      <h1>Halo calon pengantin yang berbahagia!</h1>
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
        </div>
    </div>
</div>
      
@endsection