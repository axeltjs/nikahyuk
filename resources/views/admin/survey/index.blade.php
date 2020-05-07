@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}">

    <style>
        .form_wizard .stepContainer{
            display: none !important;
        }
    </style>
@endsection
@section('content')
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Halaman Survey</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Survey <small>sesuaikan dengan budget dan kebutuhan Anda</small></h2>
                    <div class="clearfix"></div>
                </div>
                @include('admin.survey.form')
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
@section('js')
<script src="{{ asset('admin/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap-datetimepicker -->    
<script src="{{ asset('admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
    $('.datepicker').datetimepicker({
        format: 'DD-MM-YYYY',
        widgetPositioning:{
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });

    $('document').ready(function(){
        $('.buttonFinish').on('click', function(){
            $('form').submit();
        });
    })
</script>
@endsection
