@extends('admin.layouts.app')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .warning-pass{
            color:red;
        }
    </style>
@endsection
@section('content')

<div class="title-block">
	<div class="pull-left">
		<h1 class="title"> User </h1>
		<p class="title-description"> Lembar pengisian data user sistem</p>
	</div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Buat User</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
		@if($method == 'create')
			<form method="post" action="{{ url('admin/user/') }}" >
		@else 
			{!! Form::model($item,['url' => [url('admin/user')."/".$item->id],'method' => 'Put']) !!}			
		@endif
			<div class="panel panel-default">
				<div class="panel-body form-horizontal tasi-form" id="form-utama">
					{{ csrf_field() }}
					@include('admin.user._form')
				</div>
			</div>
		</form>
    </div>
</div>
        

@endsection

@section('js')
<script src="{{ asset('js/passwordChecker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
	$(document).ready(function(){
		$('.select2').select2();
	});
</script>

@endsection