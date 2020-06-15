@extends('admin.layouts.app')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
	<link href="{{ asset('admin/vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">
    <style>
        .warning-pass{
            color:red;
        }
    </style>
@endsection
@section('content')

<div class="page-title">
    <div class="title_left">
        <h3 class="title">Promosi</h3>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Buat Promosi</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
		@if($method == 'create')
			<form method="post" action="{{ url('vendor/promotion/') }}" enctype="multipart/form-data">
		@else 
			{!! Form::model($item,['url' => [url('vendor/promotion')."/".$item->id],'method' => 'Put','files'=>'true']) !!}			
		@endif
			<div class="panel panel-default">
				<div class="panel-body form-horizontal tasi-form" id="form-utama">
					{{ csrf_field() }}
					@include('admin.promotion._form')
				</div>
			</div>
		</form>
    </div>
</div>
        

@endsection

@section('js')
<script src="{{ asset('js/passwordChecker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="{{ asset('admin/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
<script src="{{ asset('admin/vendors/google-code-prettify/src/prettify.js') }}"></script>
<script>
</script>

@endsection