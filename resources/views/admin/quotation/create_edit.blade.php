@extends('admin.layouts.app')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="title-block">
	<div class="pull-left">
		<h1 class="title"> Penawaran </h1>
		<p class="title-description"> Lembar pengisian data penawaran kepada customer</p>
	</div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Buat Penawaran</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
		@if($method == 'create')
			<form method="post" action="{{ url('vendor/quotation/') }}" enctype="multipart/form-data">
		@else 
			{!! Form::model($item,['url' => [url('vendor/quotation')."/".$item->id],'method' => 'Put', 'files' => true]) !!}			
		@endif
			<div class="panel panel-default">
				<div class="panel-body form-horizontal tasi-form" id="form-utama">
					{{ csrf_field() }}
					@include('admin.quotation._form')
				</div>
			</div>
		</form>
    </div>
</div>
        

@endsection

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
	var description = document.getElementById("description");
		CKEDITOR.replace(description,{
		language:'en-gb'
	});
	CKEDITOR.config.allowedContent = true;
	$(".select2").select2();

	$(document).ready(function(){
		$('#customer_id').on("change", function(e) { 
			let id = $("#customer_id :selected").val();
			$.ajax({
				url: '{{ route("vendor.get.client.budget") }}',
				method: 'GET',
				type: 'json',
				data: {
					'id': id
				},
				success: function (data) {
					$('.budget').html('Rp. ' + data);
				},
			});
		});
	});
</script>

@endsection