@extends('admin.layouts.app')
@section('css')
    <style>
        .warning-pass{
            color:red;
        }
    </style>
@endsection

@section('content')

<div class="title-block">
    <h1 class="title"> Update Profile </h1>
    <p class="title-description"> Lembar pengisian data pribadi</p>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Data Profile</h2>
    </div>
    <div class="x_content">
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::text('name', Auth::user()->name, ['class'=>'form-control','id' => 'name','autofocus', 'tabindex' => '1' ,'required']) !!}
                </div>
            </div>
            
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Email  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::email('email', Auth::user()->email, ['class'=>'form-control','id' => 'email','autofocus', 'tabindex' => '2' ,'required']) !!}
                </div>
            </div>
            
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No. Telepon  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::text('phone', Auth::user()->phone, ['class'=>'form-control','id' => 'phone','autofocus', 'tabindex' => '3' ,'required']) !!}
                </div>
            </div>

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat  <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::textarea('address', Auth::user()->address, ['class'=>'form-control','id' => 'address','autofocus', 'tabindex' => '4']) !!}
                </div>
            </div>

            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Photo Profile</label>
                <div class="col-md-6 col-sm-6 ">
                    <input type="file" name="photo">
                </div>
            </div>
            @hasrole('Customer')
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Scan KTP</label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::file('ktp_user', ['id' => 'ktp_user']) !!}
                    <br><br>
                    {!! Auth::user()->ktp_format !!}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Foto Selfie dengan KTP</label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::file('ktp_selfie', ['id' => 'ktp_selfie']) !!}
                    <br><br>
                    {!! Auth::user()->ktp_selfie_format !!}
                </div>
            </div>
            @endhasrole
            <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Scan dokumen tanda tangan syarat & ketentuan<br> 
                <a target="__blank" href="{{ asset('doc/Syarat-dan-ketentuan-nikahyuk-printable-customer.docx') }}" style="color:red; margin-top:3px;">Download format disini</a>
            </label>
                <div class="col-md-6 col-sm-6">
                    {!! Form::file('sk_photo', ['id' => 'sk_photo']) !!}
                    <br><br>
                    {!! Auth::user()->sk_format !!}
                </div>
            </div>
            
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password Baru (kosongkan bila tidak diubah)
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::password('new_password', ['class'=>'form-control','id' => 'new_password','autofocus', 'tabindex' => '5']) !!}
                </div>
            </div>
            
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Ulangi Password Baru
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::password('new_password2', ['class'=>'form-control','id' => 'new_password2','autofocus', 'tabindex' => '6']) !!}
                    <p class="help-block warning-pass">Password tidak cocok</p>
                </div>
            </div>
            
            <hr>
            <div class="item form-group">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Password Terakhir <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 ">
                    {!! Form::password('password', ['class'=>'form-control','id' => 'password','autofocus', 'tabindex' => '7' ,'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    &nbsp;
                </div>
                <div class="col-md-6">
                    {!! Form::submit('Simpan', ['class'=>'btn btn-primary btn-simpan', 'tabindex' => '8']) !!}
                </div>
            </div>
            
                    
        </form>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/passwordChecker.js') }}"></script>
@endsection