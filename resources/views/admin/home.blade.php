@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/build/css/custom.min.css') }}">
    <link href="{{ asset('admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
@endsection
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
<div class="row">
    @hasrole('Admin')
      <div class="col-md-12">
      <h1>Dashboard</h1>
      <div class="top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-users"></i></div>
            <div class="count">{{ $counted['customer'] }}</div>
            <h3>Total Customer</h3>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-bank"></i></div>
            <div class="count">{{ $counted['vendor'] }}</div>
            <h3>Total Vendor</h3>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-money"></i></div>
            <div class="count">{{ $counted['transaction'] }}</div>
            <h3>Total Transaksi</h3>
          </div>
        </div>
     </div>
     @include('admin.layouts.transaction_chart')
    </div>
    @endhasrole
    @hasanyrole('Vendor|Customer')
    <div class="col-md-8 col-sm-6 col-xs-12">
      
    <div class="x_panel">
      <h2>Notifikasi Penawaran</h2>
      <hr>
      <div class="x_content">
        <ul class="list-unstyled timeline">
          @foreach (auth()->user()->unreadNotificationOffer as $unreadNotifications)
          <li>
            <div class="block">
              <div class="tags">
                <a href="" class="tag">
                  <span>Tawaran!</span>
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
                    Klik <a target="__blank" style="color: red" href="{{ $unreadNotifications->data['next_route'] }}">menuju chat</a> untuk melanjutkan
                  @elseif ($unreadNotifications->data['from'] == 'customer')
                    Klik <a target="__blank" style="color: red" href="{{ $unreadNotifications->data['next_route'] }}">buat penawaran</a> untuk melanjutkan.
                    <br> 
                    Atau baca kebutuhan calon pengantin <a target="__blank" style="color: red" href="{{ $unreadNotifications->data['survey'] ?? '#' }}">di sini.</a>
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
    @endhasanyrole
    <div class="col-md-4 col-sm-6 col-xs-12">
        @hasrole('Customer')
          @if(auth()->user()->transaction()->hasProcessedTransaction()->count()) @else
            @isset($has_survey)
            <div class="x_content">
              <div class="bs-example-popovers mb-4">
              <div class="alert alert-success" role="alert">
                <h4 class="alert-heading"><i class="fa fa-thumbs-up"></i></h4>
                <p>Survey kamu sudah kami rekam, kamu akan diberikan notifikasi apabila ada vendor yang cocok dengan survey kamu!
                    <br>Terima kasih telah memilih Nikahyuk sebagai partner acara pernikahanmu!</p>
              </div>
            </div>
          </div>
            @endisset
          @endif
        @endhasrole
            
        @hasrole('Vendor')
        <div class="x_panel">
          <h2>Arahan Vendor</h2>
          <hr>
          <div class="x_content">
            <ol style="font-size: 16px">
              <li>Setelah berhasil login, Anda dapat mengatur konfigurasi usaha Anda di menu <b style="color:red">Konfigurasi Usaha</b> pada navigasi disebelah kiri Anda.</li>
              <li>Setelah selesai mengatur usaha Anda, Anda dapat menunggu notifikasi penawaran dikotak sebelah kiri dashboard Anda.</li>
              <li>Berikanlah penawaran terbaik Anda kepada calon pengantin</li>
              <li>Anda dapat melakukan negosiasi pada menu <b style="color:red">Chat</b> pada navigasi disebelah kiri Anda.</li>
              <li>Anda juga dapat mengajukan promosi untuk ditampilkan dihalaman depan website melalui menu <b style="color:red">Promosi</b> pada navigasi disebelah kiri Anda.</li>
            </ol>
          </div>
        </div>
        @endhasrole
    </div>
    @hasrole('Vendor')
    <div class="col-md-12 col-sm-12 col-xs-12">
     @include('admin.layouts.transaction_chart')
    </div>
    @endhasrole
</div>
      
@endsection
@section('js')
<script src="{{ asset('admin/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('admin/vendors/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<script>
  @hasanyrole('Admin|Vendor')
  var transaction = {!! $transactionChart !!};
  var data = [];
  transaction.sort();
  $.each(transaction, function(index, item){
    data.push({'y':index, 'a':item.amount});
  });

  console.log(data);
    config = {
      data: data,
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Total Pendapatan'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      parseTime: false,
      behaveLikeLine: true,
      resize: true,
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['black'],
      lineColors:['#1ABB9C']
  };
  config.element = 'area-chart';
  Morris.Area(config);
  @endhasanyrole
</script>
@endsection