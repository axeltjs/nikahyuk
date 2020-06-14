@extends('admin.layouts.app')
@section('content')
<div class="page-title">
    <div class="title_left">
        <h3 class="title">Transaksi {{ $transaction_num }}</h3>
    </div>
</div>
<div class="clearfix"></div>
<hr>
<br>
<!-- start accordion -->
<div class="x_panel">
    <div class="x_title">
        <h2>Informasi Pembayaran</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
    <p>Pembayaran dapat dilakukan melalui akun dibawah ini</p>
    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
    <div class="panel">
      <a class="panel-heading" role="tab" id="headingOne1" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
        <h4 class="panel-title">Via Bank BNI</h4>
      </a>
      <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body" style="padding-left:20px; padding-top:10px; padding-bottom:10px;">
            <h4>Transfer ATM/Mobile Banking/SMS Banking</h4>
            <h4>0438475773</h4>
            <h4>a.n. Axel Titandrias Jodi Saputra</h4>
        </div>
      </div>
    </div>
    <div class="panel">
      <a class="panel-heading collapsed" role="tab" id="headingTwo1" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo">
        <h4 class="panel-title">Via Gopay</h4>
      </a>
      <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body" style="padding-left:20px; padding-top:10px; padding-bottom:10px;">
            <img src="{{ asset('admin/images/gopay.jpeg') }}" alt="Gopay" style="max-width: 350px; height:auto;">
        </div>
      </div>
    </div>
    <div class="panel">
      <a class="panel-heading collapsed" role="tab" id="headingThree1" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1" aria-expanded="false" aria-controls="collapseThree">
        <h4 class="panel-title">Via OVO</h4>
      </a>
      <div id="collapseThree1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body" style="padding-left:20px; padding-top:10px; padding-bottom:10px;">
            <h4>a.n. Axel Saputra</h4>
            <img src="{{ asset('admin/images/ovo.jpeg') }}" alt="Gopay" style="max-width: 350px; height:auto;">
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
  <!-- end of accordion -->
@foreach($invoices as $invoice)
    <div class="x_panel">
        <div class="x_title">
            <h2>Invoice: {{ $invoice->number }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <form action="{{ url('invoice/upload-pembayaran') }}" method="post" enctype="multipart/form-data">
					  {{ csrf_field() }}
              <table class="table table-bordered">
                    <tr>
                        <th width="15%">Nominal</th>
                        <td>{{ $invoice->amount_format }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!! $invoice->status_format !!}</td>
                    </tr>
                    <tr>
                        <th>Jatuh Tempo</th>
                        <td>{!! $invoice->jatuh_tempo_format." ".$invoice->deadline_count_html !!}</td>
                    </tr>
                    @if(isset($invoice->bukti_bayar))
                    <tr>
                      <th>Bukti Pembayaran</th>
                      <td>
                        <a target="__blank" href="{{ url('storage/invoice/'.$invoice->bukti_bayar) }}">
                          <img src="{{ url('storage/invoice/'.$invoice->bukti_bayar) }}" alt="Bukti Pembayran" style="max-width: 300px; height:auto;">
                        </a>
                      </td>
                    </tr>
                    @endif
                    @hasrole('Customer')
                    <tr>
                        <th>Upload Bukti Bayar</th>
                        <td><input type="file" name="bukti_pembayaran"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            {!! Form::hidden('invoice_id', $invoice->id) !!}
                            <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-upload"></i> Kirim </button>
                            <a href="{{ url('invoice/cetak/'.$invoice->id) }}" class="btn btn-sm btn-success"><i class="fa fa-upload"></i> Download Receipt</a>
                        </td>
                    </tr>
                    @endhasrole
                    @hasrole('Admin|Vendor')
                    <tr>
                      <td colspan="2">
                          <a href="{{ url('invoice/cetak/'.$invoice->id) }}" class="btn btn-sm btn-success"><i class="fa fa-upload"></i> Download Receipt</a>
                      </td>
                  </tr>
                    @endhasrole
                </table>
            </form>
        </div>
    </div>
@endforeach
@endsection