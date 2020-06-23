@extends('admin.layouts.app')
@section('css')
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ asset('admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Item Acara Terbanyak </h3>
        <a target="__blank" href="{{ url('admin/laporan/item-acara/cetak?q='.Request::get('q').'&date='.Request::get('date')) }}" class="btn btn-primary"> <i class="fa fa-print"></i> Cetak</a>
    </div>
    <div class="title_right">
        <form action="{{ URL::current() }}" method="GET">
            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                <div class="input-group">
                {{-- <input type="text" class="form-control" placeholder="Search for..."> --}}
                {!! Form::text('q', Request::get('q'), ['placeholder' => 'Pencarian ...','class' => 'form-control']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-success" style="color:#fff">Go!</button>
                </span>
                </div>
            </div>
        </form>
         <form action="{{ URL::current() }}" method="GET">
            <div class="col-5" style="display: inline-flex; float: right;">
                <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="date" style="width: 150px;" id="reservation" class="form-control" value="{{ Request::get('date') }}" />
                </div>
                <button class="btn btn-warning btn-sm" style="color:#fff; height:38px;">Go!</button>
            </div>
        </form>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Laporan Item Acara</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
                @endforeach
            </table>
        @endif
    </div>
</div>
@endsection
@section('js')
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{ asset('admin/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
@endsection