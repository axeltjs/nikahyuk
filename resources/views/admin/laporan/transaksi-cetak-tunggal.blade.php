<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ public_path('admin/vendors/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">
    
    <title>Laporan Transaksi {{ $item->number }}</title>
</head>
<body>
<h3>Laporan Transaksi: {{ $item->number }}</h3>
<table class="table table-bordered">
    <tr class="alert-info">
        <th colspan="2">Kelengkapan data customer</th>    
    </tr>
    <tr>
        <th width="15%">Nama</th>    
        <td>{{ $item->customer->name }}</td>
    </tr>
    <tr>
        <th width="15%">Email</th>    
        <td>{{ $item->customer->email }}</td>
    </tr>
    <tr>
        <th width="15%">No. Telepon</th>    
        <td>{{ $item->customer->phone }}</td>
    </tr>
    <tr>
        <th width="15%">Alamat</th>    
        <td>{{ $item->customer->address }}</td>
    </tr>
    <tr>
        <th width="15%">KTP</th>    
        <td>{!! $item->customer->ktp_format ?? '<span style="color:red">Customer ini belum mengupload KTP</span>' !!}</td>
    </tr>
    <tr>
        <th width="15%">Selfie & KTP</th>    
        <td>{!! $item->customer->ktp_selfie_format ?? '<span style="color:red">Customer ini belum mengupload Selfie & KTP</span>' !!}</td>
    </tr>
    <tr>
        <th width="15%">Persetujuan S&K</th>    
        <td>{!! $item->customer->sk_format ?? '<span style="color:red">Customer ini belum mengupload Persetujuan Syarat dan ketentuan</span>' !!}</td>
    </tr>
</table>
<hr>
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
        <td> {{ $item->customer->name }}</td>
    </tr>
    <tr>
        <th>Status</th>    
        <td>{!! $item->status_format_html !!}</td>
    </tr>   
    <tr>
        <th>Paket Penawaran Terpilih</th>
        <td>{{ $item->quotation->package_name }}</td>
    </tr>
</table>   
@if($item->invoice->count())
    <table class="table table-striped">
        <tr class="success">
            <th>Nomor Invoice</th>
            <th>Jumlah</th>
            <th>Jatuh Tempo</th>
            <th>Status</th>
        </tr>
        @foreach($item->invoice as $invoice)
            <tr>
                <td>{{ $invoice->number }}</td>
                <td>{{ $invoice->amount_format }}</td>
                <td>{{ $invoice->jatuh_tempo_format }}</td>
                <td>{!! $invoice->status_format !!}</td>
            </tr>
        @endforeach
    </table>
@endif
</body>
</html>
