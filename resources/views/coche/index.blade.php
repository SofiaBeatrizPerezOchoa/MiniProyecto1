<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Coches</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
            </tr>
        </thead>

        <tbody>
            @foreach($coches as $coche)
            <tr>
                <td>{{$coche->matricula}}</td>
                <td>{{$coche->marca}}</td>
                <td>{{$coche->modelo}}</td>
                <td>{{$coche->año}}</td>
                <td>{{$coche->color}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>