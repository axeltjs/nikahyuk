<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ public_path('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ public_path('admin/vendors/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">
    
    <title>Laporan Event Item</title>
</head>
<body>
    <h1>Laporan Event Item</h1>
    <h4>Periode: {{ date('d-m-Y', strtotime($date['date'])) }} s/d {{ date('d-m-Y', strtotime($date['date_end'])) }} </h4>
    <hr>
    @if($items)
        <table class="table table-bordered">
            <tr>
                <th width="1%">No</th>
                <th>Nama</th>
                <th>Jumlah</th>
            </tr>
            @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->jumlah }}</td>
            </tr>
            @endforeach
        </table>
    @else 
        Tidak ada Transaksi
    @endif    
</body>
</html>