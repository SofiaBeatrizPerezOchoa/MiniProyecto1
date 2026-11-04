<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Alquileres</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Coche</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Costo Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($alquileres as $alquiler)
            <tr>
                <td>{{$alquiler->id}}</td>
                <td>{{$alquiler->cliente->nombre}}</td>
                <td>{{$alquiler->coche->marca}} {{$alquiler->coche->modelo}}</td>
                <td>{{$alquiler->fecha_inicio}}</td>
                <td>{{$alquiler->fecha_fin}}</td>
                <td>${{$alquiler->costo_total}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>