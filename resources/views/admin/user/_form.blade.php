<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama  <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::text('name', null, ['class'=>'form-control','id' => 'name','autofocus', 'tabindex' => '1']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email  <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::email('email', null, ['class'=>'form-control','id' => 'email','autofocus', 'tabindex' => '2']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Telepon  <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::text('phone', null, ['class'=>'form-control','id' => 'phone','autofocus', 'tabindex' => '3']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat  <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::textarea('address', null, ['class'=>'form-control','id' => 'address','autofocus', 'tabindex' => '4']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Role <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::select('role_id', $roles, null, ['class'=>'form-control select2','id' => 'role_id','autofocus', 'tabindex' => '5']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password Baru (kosongkan bila tidak diubah)
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::password('new_password', ['class'=>'form-control','id' => 'new_password','autofocus', 'tabindex' => '6']) !!}
	</div>
</div>

<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Ulangi Password Baru
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::password('new_password2', ['class'=>'form-control','id' => 'new_password2','autofocus', 'tabindex' => '7']) !!}
		<p class="help-block warning-pass">Password tidak cocok</p>
	</div>
</div>

@if($method == 'edit')
<hr>
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password Terakhir <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::password('password', ['class'=>'form-control','id' => 'password','autofocus', 'tabindex' => '8']) !!}
	</div>
</div>
@endif
<div class="form-group">
	<div class="col-md-3">
		&nbsp;
	</div>
	<div class="col-md-6">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary btn-simpan', 'tabindex' => '9']) !!}
	</div>
</div>

