<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Coches</title>
</head>
<body>
    <h1>Lista de Coches</h1>

    <a href="{{ route('coche.create') }}">Crear Coche</a>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Grupo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Puertas</th>
                <th>Plazas</th>
                <th>Maletero</th>
                <th>Edad mínima</th>
                <th>Código oficina</th>
                <th>Estado</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coches as $coche)
            <tr>
                <td>{{ $coche->matricula }}</td>
                <td>{{ $coche->grupo }}</td>
                <td>{{ $coche->marca }}</td>
                <td>{{ $coche->modelo }}</td>
                <td>{{ $coche->numero_puertas }}</td>
                <td>{{ $coche->numero_plazas }}</td>
                <td>{{ $coche->capacidad_maletero }}</td>
                <td>{{ $coche->edad_minima }}</td>
                <td>{{ $coche->codigo_oficina }}</td>
                <td>{{ $coche->estado }}</td>
                <td><a href="{{ route('coche.show', $coche->id) }}">Ver</a></td>
                <td><a href="{{ route('coche.edit', $coche->id) }}">Editar</a></td>
                <td>
                    <form action="{{ route('coche.destroy', $coche->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este coche?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
