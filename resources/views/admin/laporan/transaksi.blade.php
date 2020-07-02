@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}">
@endsection
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Transaksi </h3>
    </div>
    <div class="title_right">
    </div>
</div>
<form action="{{ URL::current() }}" method="GET">
    <div class="col-md-12" style="display: inline-flex">
        {{-- <input type="text" class="form-control" placeholder="Search for..."> --}}
        <div class="col-md-3 col-sm-12">
            <div class="input-prepend input-group">
                <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" name="date" style="width: 150px;" id="reservation" class="form-control" value="{{ Request::get('date') }}" />
            </div>
        </div>
        <div class="col-md-1 col-sm-12">
            {!! Form::select('status', ['null' => 'Status Transaksi ...' ,'0' => 'Diproses', '1' => 'Disetujui', '2' => 'Ditolak', '3' => 'Selesai'], Request::get('status'), ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-2 col-sm-12">
            {!! Form::select('payment_method', ['null' => 'Metode Pembayaran ...', 'Cash' => 'Cash', '2' => 'Kredit 2x Cicilan', '3' => 'Kredit 3x Cicilan', '4' => 'Kredit 4x Cicilan'], Request::get('payment_method'), ['class' => 'form-control']) !!}
        </div>
        <div class="col-md-2 col-sm-12">
            {!! Form::text('nama', Request::get('nama'), ['placeholder' => 'Customer ...','class' => 'form-control']) !!}
        </div>
        <div class="col-md-2 col-sm-12">
            {!! Form::text('vendor', Request::get('vendor'), ['placeholder' => 'Vendor ...','class' => 'form-control']) !!}
        </div>
        <div class="col-md-2 col-sm-12">
            {!! Form::text('nomor', Request::get('nomor'), ['placeholder' => 'Cari Nomor Transaksi ...','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="col-md-6">
            <a href="{{ url('laporan/transaksi/cetak?status='.Request::get('status').'&date='.Request::get('date').'&payment_method='.Request::get('payment_method').'&nama='.Request::get('nama').'&vendor='.Request::get('vendor').'&nomor='.Request::get('nomor')) }}" class="btn btn-primary btn-block"> <i class="fa fa-print"></i> Cetak</a>
        </div>
        <div class="col-md-6">  
            <button class="btn btn-success btn-block" style="color:#fff"> <i class="fa fa-search"></i> Cari</button>
        </div>
    </div>
</form>
<div class="x_panel">
    <div class="x_title">
        <h2>Laporan Transaksi</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>Nomor Transaksi</th>
                    <th>Vendor</th>
                    <th>Customer</th>
                    <th>Nilai</th>
                    <th>Metode Pembayaran</th>
                    <th>Status</th>
                    <th>Tanggal Transaksi</th>
                    <th width="15%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->vendor->company->name }}</td>
                    <td>{{ $item->amount_format }}</td>
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ $item->payment_method_format }}</td>
                    <td>{!! $item->status_format_html !!}</td>
                    <td>{{ $item->created_at_format }}</td>
                    <td>
                        <a href="{{ url('laporan/transaksi/'.$item->id.'') }}" class="btn btn-info"> <i class="fa fa-print"></i> Cetak</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection
@section('js')
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script>
    </script>    
@endsection