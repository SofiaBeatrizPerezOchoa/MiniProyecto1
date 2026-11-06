@extends('layouts.app')

@section('title', 'Lista de Clientes')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Clientes</h1>
                <a href="{{ route('cliente.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nuevo Cliente
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="panel p-3 p-md-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tablaClientes">
                        <thead>
                            <tr>
                                <th scope="col">DNI</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Tarjeta de Crédito</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clientes as $cliente)
                                <tr>
                                    <td class="fw-semibold">{{ $cliente->DNI }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->tarjeta_credito ?? '—' }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('cliente.show', $cliente->DNI) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('cliente.edit', $cliente->DNI) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('cliente.destroy', $cliente->DNI) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger action-btn px-3">
                                                    <i class="bi bi-trash3 me-1"></i>Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No hay clientes registrados. <a href="{{ route('cliente.create') }}">Crea el primero</a>.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        
@endsection
