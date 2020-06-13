@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Transaksi </h3>
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
        <h2>Daftar Transaksi</h2>
        {{-- <a href="{{ url('admin/user/create') }}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Tambah User</a> --}}
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    @hasanyrole('Customer|Vendor')
                    <th>Nama</th>
                    @endhasanyrole
                    @hasrole('Admin')
                    <th>Nama Customer</th>
                    <th>Nama Vendor</th>
                    @endhasrole
                    <th>Harga Kesepakatan</th>
                    <th>Metode Pembayaran</th>
                    <th>Tgl. Transaksi</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @hasrole('Customer')
                    <td>{{ $item->vendor->name }}</td>
                    @endhasrole
                    @hasrole('Vendor')
                    <td>{{ $item->customer->name }}</td>
                    @endhasrole
                    @hasrole('Admin')
                    <td>{{ $item->customer->name }}</td>
                    <td>{{ $item->vendor->name }}</td>
                    @endhasrole
                    <td>{{ $item->amount_format }}</td>
                    <td>{{ $item->payment_method_format }}</td>
                    <td>{{ $item->created_at_format }}</td>
                    <td>{!! $item->status_format_html !!}</td>
                    <td>
                        <a href="{{ url('transaction/'.$item->id) }}" class="btn btn-info"> Detail</a>
                        {{-- <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('admin/user/'.$item->id) }}" class="btn btn-danger"> Delete</a> --}}
                        {{-- <a href="{{ url('admin/user/'.$item->id.'/edit') }}" class="btn btn-warning">Edit</a> --}}
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection