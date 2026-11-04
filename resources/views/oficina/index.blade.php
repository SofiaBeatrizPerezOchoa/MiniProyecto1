<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Oficinas</h1>

<table border="1">
    <thead>
        <tr>
            <th>Código</th>
            <th>Ciudad</th>
            <th>Calle</th>
            <th>Número</th>
            <th>Teléfono</th>
        </tr>
    </thead>

    <tbody>
        @foreach($oficinas as $oficina)
        <tr>
            <td>{{$oficina->codigo_oficina}}</td>
            <td>{{$oficina->ciudad}}</td>
            <td>{{$oficina->calle}}</td>
            <td>{{$oficina->numero}}</td>
            <td>{{$oficina->telefono}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>