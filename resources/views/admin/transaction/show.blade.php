@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Transaksi </h3>
    </div>
    
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Detail Transaksi</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table class="table table-bordered">
            <tr class="alert-success">
                <th colspan="2">Data Transaksi</th>    
            </tr>
            <tr>
                <th width="15%">No. Transaksi</th>    
                <td>{{ $item->number }}</td>
            </tr>    
            <tr>
                <th>Harga Penawaran</th>
                <td style="color: orange;">{{ $item->quotation->price_format ?? '-' }}</td>
            </tr>
            <tr>
                <th>Harga Kesepakatan</th>    
                <td style="color: green;">{{ $item->amount_format }}</td>
            </tr>
            <tr>
                <th>Metode Pembayaran</th>    
                <td>{{ $item->payment_method_format }}</td>
            </tr>
            <tr>
                <th>Vendor</th>
                <td>{{ $item->vendor->company->name }}</td>
            </tr>    
            <tr>
                <th>Customer</th>
                <td>{{ $item->customer->name }}</td>
            </tr>
            <tr>
                <th>Status</th>    
                <td>{!! $item->status_format_html !!}</td>
            </tr>   
            <tr>
                <th>Paket Penawaran Terpilih</th>
                <td>{{ $item->quotation->package_name }}</td>
            </tr>
            <tr>
                <th>Informasi Detail Penawaran</th>
                <td>
                    <a target="__blank" href="{{ url('quotation/'.$item->quotation_id) }}" class="btn btn-info"> <i class="fa fa-cloud-download"></i> Download File</a>
                </td>
            </tr>
            @if($item->status === 1 || $item->status === 3)
            <tr>
                <th>Lihat Informasi Pembayaran</th>
                <td>
                    <a target="__blank" href="{{ url('quotation/'.$item->quotation_id) }}" class="btn btn-primary"> <i class="fa fa-newspaper-o"></i> Pembayaran</a>
                </td>
            </tr>
            @endif
        </table>          
        @hasrole('Vendor')
        @if($item->status == 0)
        <hr>
        <div class="panel panel-default">
            <div class="panel-body form-horizontal tasi-form" id="form-utama">
                <div class="item form-group">
                    </label>
                    <div class="col-md-12 col-sm-12 ">
                        <button type="button" class="btn btn-success" onclick="approve(1)">Setuju</button>
                        <button type="button" class="btn btn-danger" onclick="approve(0)">Tidak Setuju</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endhasrole
    </div>
</div>

<!-- Modal -->
<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
    <form action="{{ route('vendor.transaction.deal') }}" method="post">
        {{ csrf_field() }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h5>Apakah anda yakin?</h5>
            <h6>Anda akan <b><span id="keterangan"></span></b> transaksi ini</h6>
            <input type="hidden" name="transaction_id" id="transaction_id" value="{{ $item->id }}">
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
        let approve = (stats) => {
            $('#confirmModal').modal('show');
            $('#status').val(stats);
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