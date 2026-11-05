<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Coche</title>
</head>
<body>
    <h1>Detalle del Coche</h1>

    <table border="1">
        <tbody>
            <tr>
                <th>Matrícula</th>
                <td>{{ $coche->matricula }}</td>
            </tr>
            <tr>
                <th>Grupo</th>
                <td>{{ $coche->grupo }}</td>
            </tr>
            <tr>
                <th>Marca</th>
                <td>{{ $coche->marca }}</td>
            </tr>
            <tr>
                <th>Modelo</th>
                <td>{{ $coche->modelo }}</td>
            </tr>
            <tr>
                <th>Número de puertas</th>
                <td>{{ $coche->numero_puertas }}</td>
            </tr>
            <tr>
                <th>Número de plazas</th>
                <td>{{ $coche->numero_plazas }}</td>
            </tr>
            <tr>
                <th>Capacidad del maletero</th>
                <td>{{ $coche->capacidad_maletero }}</td>
            </tr>
            <tr>
                <th>Edad mínima</th>
                <td>{{ $coche->edad_minima }}</td>
            </tr>
            <tr>
                <th>Código de oficina</th>
                <td>{{ $coche->codigo_oficina }}</td>
            </tr>
            <tr>
                <th>Estado</th>
                <td>{{ $coche->estado }}</td>
            </tr>
        </tbody>
    </table>

    <p>
        <a href="{{ route('coche.edit', $coche->id) }}">Editar</a>
        <a href="{{ route('coche.index') }}">Volver al listado</a>
    </p>
</body>
</html>
