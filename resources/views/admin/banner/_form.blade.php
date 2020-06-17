<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Judul <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::text('name', null, ['class'=>'form-control','id' => 'name','autofocus', 'required', 'tabindex' => '1']) !!}
	</div>
</div>
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Placeholder <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::text('placeholder', null, ['class'=>'form-control','id' => 'placeholder', 'required', 'tabindex' => '2']) !!}
	</div>
</div>
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Artikel Promosi Terkait
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::select('promotion_id', $promotions, null, ['class' => 'form-control select2']) !!}
	</div>
</div>
<div class="item form-group">
	<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Gambar <span class="required">*</span>
	</label>
	<div class="col-md-6 col-sm-6 ">
		{!! Form::file('gambar', ['class' => 'form-control']) !!}
		<small>* Rekomendasi ukuran gambar adalah 1200 x 850 px</small>
		@if($method == 'edit')
		<br>
			{!! $item->image_format !!}
		@endif
	</div>
</div>
<div class="form-group">
	<div class="col-md-3">
		&nbsp;
	</div>
	<div class="col-md-6">
		{!! Form::submit('Simpan', ['class'=>'btn btn-primary btn-simpan', 'tabindex' => '9']) !!}
	</div>
</div>



