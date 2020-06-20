@extends('layouts.app')

@section('content')
<div class="about">
    <br><br><br><br>
		<div class="container">
        <h2 class="heading-agileinfo">{{ $promo->title }}<span>By: {{ $promo->company->name }}
        </span>
        <div class="clearfix"></div>
        <br>
        </h2>
			<div class="about-grids-1">
				<div class=" wthree-about-left">
					<div class="wthree-about-left-info">
                        <img src="{!! $promo->image_format_url !!}" alt="{{ $promo->title }}" />
					</div>
				</div>
				<div class="agileits-about-right">
					{!! $promo->description !!}
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
@endsection