@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Promosi </h3>
    </div>
    <div class="title_right">
        <form action="{{ URL::current() }}" method="GET">
            <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                <div class="input-group">
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
        <h2>Daftar Promosi</h2>
        <a href="{{ url('vendor/promotion/create') }}" class="btn btn-primary btn-sm pull-right"> <i class="fa fa-plus"></i> Tambah Artikel</a>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        @if($items->isEmpty())
            <div class="alert alert-warning"> <i class="fa fa-exclamation-triangle"></i> Tidak ada data</div>
        @else 
            <table class="table table-bordered">
                <tr>
                    <th width="1%">No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th width="15%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description_shorten }}</td>
                    <td>{{ $item->status_format }}</td>
                    <td>
                        <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('vendor/promotion/'.$item->id) }}" class="btn btn-danger"> Delete</a>
                        <a href="{{ url('vendor/promotion/'.$item->id.'/edit') }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@endsection