<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <a href="/cliente/create">Crear Cliente</a>

    <table border=1s>
        <thead>
            <tr>
                <td>DNI</td>
                <td>NombreCompleto</td>
                <td>Dirección</td>
                <td>Telefono</td>
                <td>Tarjeta de Credito</td>
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </thead>
        @foreach($clientes as $cliente)
        <tbody>
            <tr> 
                <td>{{$cliente->DNI}}</td>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->tarjeta_credito}}</td>
                <td><a href="/cliente/{{$cliente->id}}/edit">Editar</a></td>
                <td><a href="/cliente/{{$cliente->id}}/delete">Eliminar</a></td>
            </tr>
        </tbody>
        @endforeach
    </table>
    
</body>
</html>