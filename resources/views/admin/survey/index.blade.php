@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <style>
        .form_wizard .stepContainer{
            display: none !important;
        }

        .adjust{
            max-width: 496px;
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
                    <span>Sesuaikan dengan budget dan kebutuhan Anda</span>
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
<script src="{{ asset('admin/vendors/iCheck/icheck.min.js') }}"></script>
<!-- bootstrap-datetimepicker -->    
<script src="{{ asset('admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- CDN -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script src="{{ asset('js/city.js') }}"></script>

<script>
$('document').ready(function(){
    var clicked = 0;

    @if($has_survey)
        let prv = @php echo $has_survey['province_id']; @endphp;
        let ct = @php echo $has_survey['city_id']; @endphp;
        getCityById(prv, ct);
        clicked = 1;
    @else 
        getProvince();
    @endif

    console.log(clicked);

    $('.select2').select2();
    
    $('.buttonFinish').on('click', function(){
        $('form').submit();
    });
    
    $('#event_date').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',
        }
    });

    $('.provinsi').on("select2:select", function(e) { 
        $('.city').empty();
        let selected_province_id = $(".provinsi :selected").val();            
        getCity(selected_province_id);
    });

    $('.select_all').on('ifChecked', function (event) {
        $('.pilihan_item_acara').iCheck('check');
        
        // if ($('.select_all').filter(':checked').length == $('.select_all').length) {
        //     $('.select_all').iCheck('check');
        // }
    });

    $('.select_all').on('ifUnchecked', function (event) {
        $('.pilihan_item_acara').iCheck('uncheck');
    });

    $('.provinsi').on('change', function(){
        if(clicked == 1){
            $('.provinsi').empty();
            $('.city').empty();
            
            clicked = 0;
            
            getProvince();
        }
        console.log(clicked); 
    });
});

</script>
@endsection
