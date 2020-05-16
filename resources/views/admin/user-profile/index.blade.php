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
        <form method="post" action="{{ route('profile.update') }}">
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