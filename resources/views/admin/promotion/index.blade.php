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
                    <th width="10%">Judul</th>
                    <th width="25%">Deskripsi</th>
                    <th width="8%">Gambar</th>
                    <th width="8%">Status</th>
                    <th width="8%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description_format }}</td>
                    <td>{!! $item->image_format !!}</td>
                    <td>{!! $item->status_format !!}</td>
                    <td>
                        <a href="{{ url('vendor/promotion/'.$item->id) }}" class="btn btn-info">Lihat Artikel</a>
                        @hasrole('Admin')
                        <button type="button" class="btn btn-success" onclick="approve(1, {{ $item->id }})">Terima</button>
                        <button type="button" class="btn btn-danger" onclick="approve(2, {{ $item->id }})">Tolak</button>
                        @endhasrole
                        @hasrole('Vendor')
                        <a data-confirm="Are you sure?" data-token="{{ csrf_token() }}" data-method="DELETE" href="{{ url('vendor/promotion/'.$item->id) }}" class="btn btn-danger"> Delete</a>
                        <a href="{{ url('vendor/promotion/'.$item->id.'/edit') }}" class="btn btn-warning">Edit</a>
                        @endhasrole
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>
@hasrole('Admin')
<!-- Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
    <form action="{{ route('admin.promotion.approval') }}" method="post">
    {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h5>Apakah anda yakin?</h5>
            <h6>Anda akan <b><span id="keterangan"></span></b> artikel promosi ini</h6>
            <input type="hidden" name="promotion_id" id="promotion_id">
            <input type="hidden" name="status" id="status">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Iya, saya yakin</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
    </div>
</div>
@endhasrole

@endsection
@section('js')
<script>
    let approve = (stats, id) => {
        $('#confirmModal').modal('show');
        $('#status').val(stats);
        $('#promotion_id').val(id);
        $('#keterangan').empty();
        if(stats == 1){
            $('#keterangan').append('menerima');
            $('#keterangan').css('color', 'green');
        }else{
            $('#keterangan').append('menolak');
            $('#keterangan').css('color', 'red');
        }
    }
</script>
@endsection