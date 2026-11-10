@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    @php($hayFiltros = $filtros['buscar'] !== '' || $filtros['tipo'] !== '' || $filtros['estado'] !== '')

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

    <form action="{{ route('usuario.index') }}" method="GET" class="row g-2 align-items-end mb-3">
        <div class="col-12 col-lg-5">
            <label for="buscar" class="form-label small text-muted mb-1">Buscar usuario</label>
            <input type="text" id="buscar" name="buscar" value="{{ $filtros['buscar'] }}" class="form-control" placeholder="Nombre, usuario o correo">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <label for="tipo" class="form-label small text-muted mb-1">Tipo de usuario</label>
            <select id="tipo" name="tipo" class="form-select">
                <option value="">Todos</option>
                <option value="administrador" @selected($filtros['tipo'] === 'administrador')>Administrador</option>
                <option value="empleado" @selected($filtros['tipo'] === 'empleado')>Empleado</option>
            </select>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <label for="estado" class="form-label small text-muted mb-1">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="">Todos</option>
                <option value="1" @selected($filtros['estado'] === '1')>Activos</option>
                <option value="0" @selected($filtros['estado'] === '0')>Inactivos</option>
            </select>
        </div>

        <div class="col-12 col-lg-3">
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel me-1"></i>Filtrar
                </button>
                <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary flex-fill">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Limpiar
                </a>
            </div>
        </div>
    </form>

    <div class="panel p-3 p-md-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Tipo de usuario</th>
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
                                @if($hayFiltros)
                                    No hay usuarios que coincidan con los filtros.
                                @else
                                    No hay usuarios registrados. <a href="{{ route('usuario.create') }}">Crea el primero</a>.
                                @endif
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
