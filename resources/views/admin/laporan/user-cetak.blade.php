<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ public_path('admin/vendors/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">
    
    <title>Laporan Transaksi {{ $user->name }}</title>
</head>
<body>
    <h1>Laporan Transaksi Customer</h1>
    <table class="table">
        <tr>
            <td>Nama</td>
            <td width="1%">:</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td width="1%">:</td>
            <td>{{ $user->phone }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td width="1%">:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td width="1%">:</td>
            <td>{{ $user->address }}</td>
        </tr>
    </table>
    <hr>
    @if($user->transaction->count())
        @foreach($user->transaction as $transaksi)
        <h4>Transaksi: {{ $transaksi->number }}</h4>
        <table class="table table-bordered">
            <tr>
                <th>Vendor</th>
                <th>Nilai Transaksi</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
            </tr>
                <tr>
                    <td>{{ $transaksi->vendor->company->name }}</td>
                    <td>{{ $transaksi->amount_format }}</td>
                    <td>{{ $transaksi->payment_method_format }}</td>
                    <td>{!! $transaksi->status_format_html !!}</td>
                </tr>
            </table>
            @if($transaksi->invoice->count())
                <table class="table table-striped">
                    <tr class="success">
                        <th>Nomor Invoice</th>
                        <th>Jumlah</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                    @foreach($transaksi->invoice as $invoice)
                        <tr>
                            <td>{{ $invoice->number }}</td>
                            <td>{{ $invoice->amount_format }}</td>
                            <td>{{ $invoice->jatuh_tempo_format }}</td>
                            <td>{!! $invoice->status_format !!}</td>
                        </tr>
                    @endforeach
                </table>
            @endif
            @endforeach
    @else 
        Tidak ada Transaksi
    @endif    
</body>
</html>