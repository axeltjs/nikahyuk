@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Konfirmasi Pembayaran </h3>
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
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Daftar Pembayaran</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>No. Invoice</th>
                    <th>Nama Customer</th>
                    <th>Nama Vendor</th>
                    <th>Jatuh Tempo</th>
                    <th>Total</th>
                    <th>Foto</th>
                    <th width="15%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->number }}</td>
                    <td>{{ $item->transaction->customer->name }}</td>
                    <td>{{ $item->transaction->vendor->company->name }}</td>
                    <td>{{ $item->amount_format }}</td>
                    <td>
                        <a target="__blank" href="{{ url('storage/invoice/'.$invoice->bukti_bayar) }}">
                            <img src="{{ url('storage/invoice/'.$invoice->bukti_bayar) }}" alt="Bukti Pembayran" style="max-width: 200px; height:auto;">
                        </a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success" onclick="approve(1)">Terima</button>
                        <button type="button" class="btn btn-danger" onclick="approve(0)">Tolak</button>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection