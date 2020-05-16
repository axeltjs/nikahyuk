@extends('admin.layouts.app')
@section('content')
<div class="title-block">
    <div class="pull-left">
        <h1 class="title"> User </h1>
        <p class="title-description"> Pengguna sistem nikahyuk</p>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Daftar User</h2>
        <a href="{{ url('admin/user/create') }}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Tambah User</a>
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
                    <th>Email</th>
                    <th>No. Telepon</th>
                    <th>Peran</th>
                    <th width="15%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->roles->first()->name }}</td>
                    <td>
                        <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('admin/user/'.$item->id) }}" class="btn btn-danger"> Delete</a>
                        <a href="{{ url('admin/user/'.$item->id.'/edit') }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection