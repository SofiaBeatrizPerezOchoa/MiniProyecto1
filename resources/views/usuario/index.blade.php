@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <h1 class="page-title h2 mb-0">Usuarios</h1>
        <a href="{{ route('usuario.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg me-1"></i>Nuevo Usuario
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="panel p-3 p-md-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        @php($rol = $usuario->getRoleNames()->first())
                        <tr>
                            <td class="fw-semibold">{{ $usuario->name }}</td>
                            <td>{{ $usuario->username }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $rol === 'administrador' ? 'text-bg-primary' : 'text-bg-info' }}">
                                    {{ ucfirst($rol ?? 'Sin rol') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge rounded-pill {{ $usuario->activo ? 'text-bg-success' : 'text-bg-secondary' }}">
                                    {{ $usuario->activo ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('usuario.edit', $usuario) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                        <i class="bi bi-pencil-square me-1"></i>Editar
                                    </a>

                                    @if($usuario->id === auth()->id())
                                        <button type="button" class="btn btn-sm btn-outline-secondary action-btn px-3" disabled title="No puedes deshabilitar tu propia cuenta">
                                            <i class="bi bi-person-check me-1"></i>Tu cuenta
                                        </button>
                                    @else
                                        <form action="{{ route('usuario.estado', $usuario) }}" method="POST" class="d-inline" onsubmit="return confirm('¿{{ $usuario->activo ? 'Deshabilitar' : 'Habilitar' }} este usuario?')">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="activo" value="{{ $usuario->activo ? 0 : 1 }}">
                                            <button type="submit" class="btn btn-sm {{ $usuario->activo ? 'btn-danger' : 'btn-success' }} action-btn px-3">
                                                <i class="bi {{ $usuario->activo ? 'bi-person-x' : 'bi-person-check' }} me-1"></i>
                                                {{ $usuario->activo ? 'Deshabilitar' : 'Habilitar' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No hay usuarios registrados. <a href="{{ route('usuario.create') }}">Crea el primero</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($usuarios->hasPages())
            <div class="mt-3">
                {{ $usuarios->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
