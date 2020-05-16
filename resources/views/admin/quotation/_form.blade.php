<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Pelanggan
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::select('customer_id', $user, null, ['class'=>'form-control select2','id' => 'customer_id','autofocus', 'tabindex' => '0', 'placeholder' => 'Pilih pelanggan']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Budget 
	</label>
	<div class="col-md-6 col-sm-6 ">
		<p style="font-size: 14px; margin-top:6px; margin-bottom:-6px;" class="budget">Rp. 0</p> 
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Paket <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::text('package_name', null, ['class'=>'form-control','id' => 'package_name','autofocus', 'tabindex' => '1']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Harga Paket <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::number('price', old('price'), ['class' => 'has-feedback-left form-control angka', 'required', 'id' => 'price', 'tabindex' => '2']) !!}
		<span class="fa fa-rupiah form-control-feedback left" aria-hidden="true">Rp.</span>
		<span id="inputSuccess2Status2" class="sr-only">(success)</span>
	</div>
</div>

@if(Request::get('type') == 'upload')
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Upload Penawaran 
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::file('file', null, ['class' => 'form-control']) !!}
	</div>
</div>
@else 
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Deskripsi Penawaran
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::textarea('description', null, ['class'=>'form-control','id' => 'description', 'tabindex' => '3']) !!}
	</div>
</div>
@endif

<div class="form-group">
	<div class="col-md-3">
		&nbsp;
	</div>
	<div class="col-md-6">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary btn-simpan', 'tabindex' => '4']) !!}
	</div>
</div>

