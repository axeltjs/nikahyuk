<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ public_path('admin/vendors/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">
    
    <title>Laporan Transaksi</title>
</head>
<body>
    <h1>Laporan Transaksi</h1>
    @if($date['date'] != $date['date_end'])
        <h4>Periode: {{ date('d-m-Y', strtotime($date['date'])) }} s/d {{ date('d-m-Y', strtotime($date['date_end'])) }} </h4>
    @endif
    <hr>
    @if($items)
        @foreach($items as $item)
            <table class="table table-bordered">
                <tr class="btn-success">
                    <th width="27%">Nomor Transaksi</th>
                    <td>{{ $item->number }}</td>
                </tr>
                <tr>
                    <th>Vendor</th>
                    <td>{{ $item->vendor->company->name }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>
                        {{ $item->customer->name }}
                    </td>
                </tr>
                <tr>
                    <th>Nilai Transaksi</th>
                    <td>
                        {{ $item->amount_format }}
                    </td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $item->payment_method_format }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{!! $item->status_format_html !!}</td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ $item->created_at_format }}</td>
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
            <hr>
        @endforeach
    @else 
        Tidak ada Transaksi
    @endif    
</body>
</html>