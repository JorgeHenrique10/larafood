<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div style="text-align: center" class="visible-print">
        {!! QrCode::size(300)->generate($url); !!}
        <p>{{$url}}</p>
    </div>
</body>
</html>
