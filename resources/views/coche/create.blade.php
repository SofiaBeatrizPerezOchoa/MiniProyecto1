<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Coche</title>
</head>
<body>
    <h1>Crear Coche</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('coche.store') }}" method="POST">
        @csrf

        <p>
            <label for="matricula">Matrícula</label><br>
            <input type="text" id="matricula" name="matricula" value="{{ old('matricula') }}" maxlength="20" required>
        </p>

        <p>
            <label for="grupo">Grupo</label><br>
            <input type="text" id="grupo" name="grupo" value="{{ old('grupo') }}" maxlength="20" required>
        </p>

        <p>
            <label for="marca">Marca</label><br>
            <input type="text" id="marca" name="marca" value="{{ old('marca') }}" maxlength="50" required>
        </p>

        <p>
            <label for="modelo">Modelo</label><br>
            <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" maxlength="50" required>
        </p>

        <p>
            <label for="numero_puertas">Número de puertas</label><br>
            <input type="number" id="numero_puertas" name="numero_puertas" value="{{ old('numero_puertas') }}" min="1" required>
        </p>

        <p>
            <label for="numero_plazas">Número de plazas</label><br>
            <input type="number" id="numero_plazas" name="numero_plazas" value="{{ old('numero_plazas') }}" min="1" required>
        </p>

        <p>
            <label for="capacidad_maletero">Capacidad del maletero</label><br>
            <input type="number" id="capacidad_maletero" name="capacidad_maletero" value="{{ old('capacidad_maletero') }}" min="0" required>
        </p>

        <p>
            <label for="edad_minima">Edad mínima</label><br>
            <input type="number" id="edad_minima" name="edad_minima" value="{{ old('edad_minima') }}" min="0" required>
        </p>

        <p>
            <label for="codigo_oficina">Código de oficina</label><br>
            <input type="text" id="codigo_oficina" name="codigo_oficina" value="{{ old('codigo_oficina') }}" maxlength="10" required>
        </p>

        <p>
            <label for="estado">Estado</label><br>
            <input type="text" id="estado" name="estado" value="{{ old('estado') }}" maxlength="20" required>
        </p>

        <button type="submit">Guardar</button>
        <a href="{{ route('coche.index') }}">Cancelar</a>
    </form>
</body>
</html>
