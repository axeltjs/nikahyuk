@extends('admin.layouts.app')
@section('css')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="title-block">
	<div class="pull-left">
		<h1 class="title"> Persetujuan Usaha </h1>
	</div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Vendor Wedding Organizer</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
		<table class="table table-bordered">
			<tr>
				<th width="20%">Status Usaha</th>
				<td>{!! $item->approved_format !!}</td>
			</tr>
			@if($item->reject_reason != null && $item->approved == 2)
			<tr>
				<th>Alasan Penolakan</th>
				<td>{!! $item->reject_reason !!}</td>
			</tr>
			@endif
			<tr>
				<th>Nama Usaha</th>
				<td>{{ $item->name }}</td>
			</tr>
			<tr>
				<th>Nama Pemilik Usaha</th>
				<td>{{ $item->user->name }}</td>
			</tr>
			<tr>
				<th>No. Telepon</th>
				<td>{{ $item->user->phone }}</td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td>{{ $item->address }}</td>
			</tr>
			<tr>
				<th>Range Harga</th>
				<td>{{ $item->min_max_budget }}</td>
			</tr>
			<tr>
				<th>Kelengkapan berkas <br>(KTP, NPWP, Izin Usaha, Tempat Usaha)</th>
				<td>
					{!! $item->ktp_format !!} 
					<br>
					<br>
					{!! $item->npwp_format !!} 
					<br>
					<br>
					{!! $item->izin_usaha_format !!} 
					<br>
					<br>
					{!! $item->tempat_usaha_format !!} 
				</td>
			</tr>
			<tr>
				<th>Disetujui?</th>
				<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTerima">Ya</button> &nbsp; <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalTolak">Tidak</button> </td>
			</tr>
		</table>
    </div>
</div>
<div id="modalTerima" class="modal fade" role="dialog">
	<div class="modal-dialog">
  
	  <!-- Modal content-->
	  <div class="modal-content">
		{!! Form::model($item,['url' => [url('admin/vendor/validation')."/".$item->id],'method' => 'Put']) !!}			
		{{ csrf_field() }}
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		  {!! Form::hidden('approved', 1) !!}
		  <h3>Anda yakin menerima vendor ini sebagai partner Nikahyuk?</h3>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Ya</button>
		 	<button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Tidak</button>
		</div>
	  </div>
	</form>
	</div>
  </div>

  <div id="modalTolak" class="modal fade" role="dialog">
	<div class="modal-dialog">
  
	  <!-- Modal content-->
	  <div class="modal-content">
		{!! Form::model($item,['url' => [url('admin/vendor/validation')."/".$item->id],'method' => 'Put']) !!}			
		{{ csrf_field() }}
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
		  <h3>Anda yakin menolak vendor ini sebagai partner Nikahyuk?</h3>
		  <h2>Berikan alasannya:</h2>
		  <small>Wajib diisi *</small>
		  {!! Form::hidden('approved', 2) !!}
			{!! Form::textarea('reject_reason', old('reject_reason'), ['required','class' => 'form-control','placeholder' => 'Tulis alasan penolakan']) !!}
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Ya</button>
		 	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Tidak</button>
		</div>
		</form>
	  </div>
  
	</div>
  </div>
  

@endsection

@section('js')

@endsection