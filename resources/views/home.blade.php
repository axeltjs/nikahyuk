@extends('layouts.app')

@section('content')
    <!-- ser_agile -->
    <div class="ser_agile" id="fitur">
        <div class="container">
        <h2 class="heading-agileinfo">Selamat Datang<span>Nikahyuk memberikan kemudahan dalam merencanakan pernikahanmu!</span></h2>
        <p>Kami berkomitmen untuk membantu dan mensukseskan acara pernikahanmu dari perencanaan hingga selesai. Bergabunglah dengan kami dan dapatkan layanan terbaik dari mitra kami.</p>
        <div class="ser_w3l">  
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Mudah</h4>
                <p>Cukup daftar dan isi kepeluanmu untuk mendapatkan penawaran paket pernikahan yang terbaik.</p>
                </div>
            </div>
            </div>
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                <i class="fa fa-gears" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Otomatis</h4>
                <p>Setelah kamu sudah mengisi kebutuhanmu, sistem akan mencarikan vendor yang cocok untukmu!</p>
                </div>
            </div>
            </div>
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                <i class="fa fa-certificate" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Terpercaya</h4>
                <p>Kami akan memberikan garansi uang kembali apabila terjadi hal yang tidak diinginkan.</p>
                </div>
            </div>
            </div>
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Negosiasi</h4>
                <p>Kamu dapat bernegosiasi dan konsultasikan kebutuhanmu kepada mitra kami.</p>
                </div>
            </div>
            </div>
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                </span><i class="fa fa-percent" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Angsuran tanpa bunga</h4>
                <p>Kamu juga dapat bertransaksi secara kredit dan tanpa bunga!</p>
                </div>
            </div>
            </div>
            <div class="outer-wrapper">
            <div class="inner-wrapper">
                <div class="icon-wrapper">
                </span><i class="fa fa-money" aria-hidden="true"></i>
                </div>
                <div class="content-wrapper">
                <h4>Pembayaran Mudah</h4>
                <p>Tersedia pembayaran dengan transfer dan e-money.</p>
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
            </div>
        </div>
    </div>
<!-- //ser_agile -->
<!-- Stats -->
<div class="stats-agileits">
<div class="container">
    <h3 class="heading-agileinfo white-w3ls">Sebuah kebanggaan kami<span class="black-w3ls">Ketika semua pelanggan merasa puas terhadap layanan kami.</span></h3>
</div>
    <div class="stats-info agileits w3layouts">
    <div class="container">
        <div class="col-md-4 col-sm-4agileits w3layouts stats-grid stats-grid-1">
            <i class="fa fa-users" aria-hidden="true"></i>
            <div class="numscroller agileits-w3layouts" data-slno='1' data-min='0' data-max='{{ $numbers['client'] }}' data-delay='3' data-increment="2">{{ $numbers['client'] }}</div>
            <div class="stat-info-w3ls">
                <h4 class="agileits w3layouts">Happy Clients</h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 agileits w3layouts stats-grid stats-grid-2">
            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
            <div class="numscroller agileits-w3layouts" data-slno='1' data-min='0' data-max='{{ $numbers['transaksi'] }}' data-delay='3' data-increment="2">{{ $numbers['transaksi'] }}</div>
            <div class="stat-info-w3ls">
                <h4 class="agileits w3layouts">Transaksi</h4>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 stats-grid agileits w3layouts stats-grid-3">
        <i class="fa fa-bank" aria-hidden="true"></i>
            <div class="numscroller agileits-w3layouts" data-slno='1' data-min='0' data-max='{{ $numbers['vendor'] }}' data-delay='3' data-increment="2">{{ $numbers['vendor'] }}</div>
            <div class="stat-info-w3ls">
                <h4 class="agileits w3layouts">Mitra Nikahyuk</h4>
            </div>
        </div>
        <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //Stats -->

<!-- showcase_w3layouts -->	
<div class="showcase_w3layouts" id="paket-nikah">
    <div class="container">
    <h3 class="heading-agileinfo">Paket Pernikahan <span>Lihatlah beberapa paket pernikahan dari kami</span></h3>
        <div class="our_agile-info">
            @foreach ($promos as $promo)
                <div class="col-md-4 popular-grid">
                    <img src="{{ $promo->image_format_url }}" class="img-responsive" alt="">
                        <div class="popular-text">
                            <h5><a href="{{ url('promo/'.$promo->id) }}">{{ $promo->title }}</a></h5>
                            <div class="detail-bottom">
                                <small>{!! $promo->company->overall_score !!}</small>
                                <br>
                                <br>
                                <h4>
                                    By: {{ $promo->company->name }}
                                </h4>
                                <p style="text-align: left">
                                    {{ $promo->description_format }}
                                </p>
                                <br>
                            </div>
                        </div>
                </div>
            @endforeach
        <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- //showcase_w3layouts -->	
<section class="about_agile" id="nilai-ulasan">
    <div class="container">	
                <h3 class="heading-agileinfo white-w3ls">Nilai & Ulasan</h3>
        <div class="about-grids" style="background: transparent;">
            
            <div class="flex-slider">
        <ul id="flexiselDemo1">			
            @foreach ($ratings as $rating)
                <li>
                    <div class="laptop">
                        <div class="col-md-8 team-right">
                            <p style="color:#fff !important;">
                                <br>{{ $rating->review }}
                            </p>
                            <div class="name-w3ls">
                                <h5>{{ $rating->customer->name }}</h5>
                                <div style="display: inline-flex">{!! $rating->nilai !!}</div>
                                <span>{{ "Kepada: ".$rating->company->name }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 team-left">
                            <img class="img-responsive" src="images/t1.jpg" alt=" " />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            @endforeach
        </ul>
        
    </div>
        </div>
    </div>
</section>
<!--testimonials-->
{{-- <div class="testimonials">
<div class="container">
    <h3 class="heading-agileinfo">Event Manager Says<span>Events is a professionally managed Event</span></h3>
    

	</div>
</div> --}}
<!--//testimonials-->
@endsection
