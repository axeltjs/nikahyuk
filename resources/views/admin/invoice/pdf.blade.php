<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $item->number }}</title>
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .custom-table tr td{
        }
        
    </style>
</head>
<body>
    <h3>Invoice: {{ $item->number }}</h3>
    <table width="100%" border="0">
        <tr>
            <td width="50%">
                <p>Dari</p>
                <p><b>CV. Keluarga Sakinah Sejahtera (Nikahyuk)</b></p>
                <p>Jl. Kh. Dewantara, No. 34, RT. 040, Sungai Pinang 75221 Samarinda</p>
                <p>082154981441</p>
                <p>halo@nikahyuk.com</p>
            </td>
            <td width="50%">
                <p>Kepada</p>
                <p><b>{{ $item->transaction->customer->name }}</b></p>
                <p>{{ $item->transaction->customer->address ?? '-' }}</p>
                <p>{{ $item->transaction->customer->phone }}</p>
                <p>{{ $item->transaction->customer->email }}</p>
            </td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="0" class="custom-table">
        <tr>
            <td><b>Jatuh tempo</b></td>
            <td>{{ $item->jatuh_tempo_format }}</td>
        </tr>
        <tr>
            <td width="25%"><b>Status Pembayaran</b></td>
            <td>{!! $item->status_format_text !!}</td>
        </tr>
        <tr>
            <td width="25%"><b>Total Pembayaran</b></td>
            <td><b>{{ $item->amount_format }}</b></td>
        </tr>
    </table>
    <hr>
    <small style="color:#ccc;">* Simpan receipt ini sebagai bukti sah transaksi</small>
</body>
</html>