<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->package_name }}</title>
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
    <div style="text-align: center">
        <h2>{{ $data->package_name }}</h2>
        <h3>Mulai dari {{ $data->price_format }}</h3>
        
    </div>
    {!! $data->description !!}
</body>
</html>