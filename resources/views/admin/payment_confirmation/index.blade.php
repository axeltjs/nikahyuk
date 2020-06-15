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
                    <th>Status</th>
                    <th>Foto</th>
                    <th width="13%">Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->number }}</td>
                    <td> 
                        <a href="{{ url('admin/user?q='.$item->transaction->customer->name) }}"> 
                            {{ $item->transaction->customer->name }} 
                        </a>
                    </td>
                    <td>{{ $item->transaction->vendor->company->name }}</td>
                    <td>{{ $item->jatuh_tempo_format }}</td>
                    <td>{{ $item->amount_format }}</td>
                    <td>{!! $item->status_format !!}</td>
                    <td>
                        @if(isset($item->bukti_bayar))
                        <a target="__blank" href="{{ url('storage/invoice/'.$item->bukti_bayar) }}">
                            <img src="{{ url('storage/invoice/'.$item->bukti_bayar) }}" alt="Bukti Pembayran" style="max-width: 200px; height:auto;">
                        </a>
                        @else 
                            <p>-</p>
                        @endif
                    </td>
                    <td>
                        @if($item->status == 2)
                        <button type="button" class="btn btn-success" onclick="approve(1, {{ $item->id }})">Terima</button>
                        <button type="button" class="btn btn-danger" onclick="approve(0, {{ $item->id }})">Tolak</button>
                        @else
                            <p>-</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $items->appends(Request::only('q'))->links() }}
        @endif
    </div>
</div>

<!-- Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
    <form action="{{ route('admin.payment.validation.confirmation') }}" method="post">
    {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h5>Apakah anda yakin?</h5>
            <h6>Anda akan <b><span id="keterangan"></span></b> pembayaran ini</h6>
            <input type="hidden" name="invoice_id" id="invoice_id">
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
@endsection


@section('js')
    <script>
        let approve = (stats, id) => {
            $('#confirmModal').modal('show');
            $('#status').val(stats);
            $('#invoice_id').val(id);
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