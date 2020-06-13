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
@foreach($invoices as $invoice)
    <div class="x_panel">
        <div class="x_title">
            <h2>Invoice: {{ $invoice->number }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="#" method="post" enctype="multipart/form-data">
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
                    @hasrole('Customer')
                    <tr>
                        <th>Upload Bukti Bayar</th>
                        <td><input type="file" name="bukti_pembayaran"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i> Upload</button>
                        </td>
                    </tr>
                    @endhasrole
                </table>
            </form>
        </div>
    </div>
@endforeach
@endsection