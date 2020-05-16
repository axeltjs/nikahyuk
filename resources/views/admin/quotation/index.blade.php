@extends('admin.layouts.app')
@section('content')
<div class="title-block">
    <div class="pull-left">
        <h1 class="title"> Penawaran </h1>
        <p class="title-description"> Penawaran yang diajukan untuk client</p>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Daftar penawaran</h2>
        <a href="{{ url('vendor/quotation/create') }}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Buat Penawaran</a>
        <a href="{{ url('vendor/quotation/create?type=upload') }}" class="btn btn-success btn-sm pull-right"> <i class="fa fa-upload"></i> Upload Penawaran</a>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th>Nama Paket</th>
                    <th>Nama Client</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pembaruan</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->package_name }}</td>
                        <td>{{ $item->client->name }}</td>
                        <td>{{ $item->price_format }}</td>
                        <td>{{ $item->updated_at->diffForHumans()  }}</td>
                        <td width="25%">
                            <a target="__blank" href="{{ url('vendor/quotation/'.$item->id) }}" class="btn btn-info"> <i class="fa fa-eye"></i> Lihat</a>
                            @if($item->file)
                                <a href="{{ url('vendor/quotation/'.$item->id.'/edit?type=upload') }}" class="btn btn-warning"> <i class="fa fa-edit"></i> Ubah</a>
                            @else
                                <a href="{{ url('vendor/quotation/'.$item->id.'/edit') }}" class="btn btn-warning"> <i class="fa fa-edit"></i> Ubah</a>
                            @endif
                            <a data-confirm="Apakah Anda yakin?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('vendor/quotation/'.$item->id) }}" class="btn btn-danger"> <i class="fa fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection