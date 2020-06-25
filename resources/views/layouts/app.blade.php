<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'Nikahyuk - Wedding Planner Apps') }}</title>
<link rel="icon" href="{{ asset('img/icon.png') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="wedding organizer, wedding planner, marriage, nikah, menikah, pernikahan" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="{{ asset('front/css/bootstrap.css') }}" type="text/css" rel="stylesheet" media="all">
<link href="{{ asset('front/css/style.css') }}" type="text/css" rel="stylesheet" media="all">  
<link href="{{ asset('front/css/font-awesome.css') }}" rel="stylesheet">		<!-- font-awesome icons -->
<!-- //Custom Theme files --> 
<!-- js -->
<script src="js/jquery-2.2.3.min.js"></script>  
<!-- //js -->
<!-- web-fonts -->  
<link href="//fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
@if(Request::segment(1) != 'promo')
@foreach($banners as $i => $item)
<style>
    .banner-{{ $i }}{
        background: url({{ $item->image_url }}) no-repeat 0px 0px;
        background-size: cover;	
        -webkit-background-size: cover;	
        -moz-background-size: cover;
        -o-background-size: cover;		
        -moz-background-size: cover;
        min-height:750px;
	}
	html {
		scroll-behavior: smooth;
	}

	.img-responsive{
		width:350px;
		height:350px;
	}
</style>
@endforeach
	@endif
<!-- //web-fonts -->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">  
	<!-- banner -->
	@if(Request::segment(1) != 'promo')
	<div id="home" class="w3ls-banner"> 
		<!-- banner-text -->
		<div class="slider">
			<div class="callbacks_container">
				<ul class="rslides callbacks callbacks1" id="slider4">
                    @foreach($banners as $i => $item)
                        <li>
                            <div class="w3layouts-banner-top {{ 'banner-'.$i }}">
                                <div class="container">
                                    <div class="agileits-banner-info">
                                        <h3>{!! $item->name !!}</h3>
                                        <p>{{ $item->placeholder }}</p>
                                        @if($item->promotion_id)
                                            <div class="agileits_w3layouts_more menu__item">
                                                <a href="{{ url('article/'.$item->promotion_id) }}" class="menu__link">Baca Lebih Lanjut</a>
                                            </div>
                                        @endif
                                    </div>	
                                </div>
                            </div>
                        </li>
                    @endforeach
				</ul>
			</div>
			<div class="clearfix"> </div>
			<!--banner Slider starts Here-->
		</div>
		 
 
	</div>	
	@endif
	<!-- //banner --> 
			<!-- header -->
		<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Nikahyuk</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.html"><img style="width:180px; height:auto;" src="{{ asset('img/nikahyuk-logo.png') }}" alt="logo"></a></h1>
					</div> 
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden"><a class="page-scroll" href="#page-top"></a>	</li>
							@if(Request::segment(1) == 'promo')
								<li><a class="hvr-sweep-to-right" href="{{ url('/#home') }}">Home</a></li>
								<li><a class="hvr-sweep-to-right" href="{{ url('/#fitur') }}">Fitur</a></li>
								<li><a class="hvr-sweep-to-right" href="{{ url('/#paket-nikah') }}">Paket Pernikahan</a></li>
								<li><a class="hvr-sweep-to-right" href="{{ url('/#nilai-ulasan') }}">Nilai & Ulasan</a></li>
							@else 
								<li><a class="hvr-sweep-to-right" href="#home">Home</a></li>
								<li><a class="hvr-sweep-to-right" href="#fitur">Fitur</a></li>
								<li><a class="hvr-sweep-to-right" href="#paket-nikah">Paket Pernikahan</a></li>
								<li><a class="hvr-sweep-to-right" href="#nilai-ulasan">Nilai & Ulasan</a></li>
							@endif
						
							<li><a class="hvr-sweep-to-right btn-success" href="{{ url('login') }}">Sign up</a></li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>  
		</div>	
		<!-- //header -->

        @yield('content')

    <!-- footer-top -->	
	<div class="footer-top">
		<div class="container">
			<div class="col-md-6 foot-left">
				<h3>Tentang Kami</h3>
			
				<p>Kami adalah sebuah platform untuk calon pengantin agar dapat membantu mereka dalam mencari Wedding Organizer yang tepat sesuai dengan kebutuhan & budget yang tersedia.</p>
			</div>
			<div class="col-md-6 foot-left">
					<h3>Kontak Kami</h3>
						<div class="contact-btm">
							<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
							<p>Jl. Adam Malik, Blok D, No. 74, Samarinda.</p>
						</div>
						<div class="contact-btm">
							<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
							<p>+628 2154 98 1441</p>
						<div class="contact-btm">
						</div>
							<span class="fa fa-envelope-o" aria-hidden="true"></span>
							<p><a href="mailto:halo@nikahyuk.online">halo@nikahyuk.online</a></p>
						</div>
						<div class="clearfix"></div>

			</div>
				<div class="clearfix"></div>
		</div>
	</div>
<!-- /footer-top -->							

<!-- footer -->
			<div class="copy-right">
				<div class="container">
				<div class="col-md-6 col-sm-6 col-xs-6 copy-right-grids">
						<div class="copy-left">
						<p>&copy; 2020 Nikahyuk. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
						</div>
					</div>
				<div class="col-md-6 col-sm-6 col-xs-6 top-middle">
						<ul>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
					</div>
			</div>
			
<!-- //footer -->
<!-- bootstrap-modal-pop-up -->
	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Events
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
					<div class="modal-body">
						<img src="images/g8.jpg" alt=" " class="img-responsive" />
						<p>Ut enim ad minima veniam, quis nostrum 
							exercitationem ullam corporis suscipit laboriosam, 
							nisi ut aliquid ex ea commodi consequatur? Quis autem 
							vel eum iure reprehenderit qui in ea voluptate velit 
							esse quam nihil molestiae consequatur, vel illum qui 
							dolorem eum fugiat quo voluptas nulla pariatur.
							<i>" Quis autem vel eum iure reprehenderit qui in ea voluptate velit 
								esse quam nihil molestiae consequatur.</i></p>
					</div>
			</div>
		</div>
	</div>
<!-- //bootstrap-modal-pop-up --> 
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>

<script src="{{ asset('front/js/jquery-2.2.3.min.js') }}"></script> 
	
<!-- skills -->

						<script src="{{ asset('front/js/responsiveslides.min.js') }}"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
			<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								  // Slideshow 4
								  $("#slider3").responsiveSlides({
									auto: true,
									pager:false,
									nav:true,
									speed: 500,
									namespace: "callbacks",
									before: function () {
									  $('.events').append("<li>before event fired.</li>");
									},
									after: function () {
									  $('.events').append("<li>after event fired.</li>");
									}
								  });
							
								});
							 </script>

<!-- start-smoth-scrolling -->
<!-- OnScroll-Number-Increase-JavaScript -->
<script type="text/javascript" src="{{ asset('front/js/numscroller-1.0.js') }}"></script>
<!-- //OnScroll-Number-Increase-JavaScript -->
<!--flexiselDemo1 -->
 <script type="text/javascript">
							$(window).load(function() {
								$("#flexiselDemo1").flexisel({
									visibleItems: 2,
									animationSpeed: 1000,
									autoPlay: true,
									autoPlaySpeed: 3000,    		
									pauseOnHover: true,
									enableResponsiveBreakpoints: true,
									responsiveBreakpoints: { 
										portrait: { 
											changePoint:480,
											visibleItems: 1
										}, 
										landscape: { 
											changePoint:640,
											visibleItems: 1
										},
										tablet: { 
											changePoint:991,
											visibleItems: 1
										}
									}
								});
								
							});
			</script>
			<script type="text/javascript" src="{{ asset('front/js/jquery.flexisel.js') }}"></script>
<!--//flexiselDemo1 -->

<script type="text/javascript" src="{{ asset('front/js/move-top.js') }}"></script>
<script type="text/javascript" src="{{ asset('front/js/easing.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
	<script src="{{ asset('front/js/bootstrap.js') }}"></script>
<!-- //for bootstrap working -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
</body>
</html>
