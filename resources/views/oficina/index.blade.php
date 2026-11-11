<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Oficinas | Renta Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
:root {
        --rc-sidebar: #a9d6e5;
        --rc-sidebar-hover: #c6e5f0;
        --rc-sidebar-active: #d7eef7;
        --rc-primary: #3fa9e6;
        --rc-primary-hover: #2f95d0;
        --rc-text: #1f2d3d;
    }

    body {
        background: #f4f7f9;
        color: var(--rc-text);
        min-height: 100vh;
    }

    .app-shell {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: 230px;
        flex-shrink: 0;
        background: var(--rc-sidebar);
        padding: 1.25rem 0.75rem;
    }

    .sidebar .brand {
        display: block;
        padding: 0.5rem 0.75rem 1.5rem;
        color: var(--rc-text);
        font-size: 1.1rem;
        font-weight: 700;
        line-height: 1.2;
        text-decoration: none;
    }

    .sidebar .nav-link {
        margin-bottom: 0.2rem;
        padding: 0.65rem 0.85rem;
        color: var(--rc-text);
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .sidebar .nav-link:hover {
        background: var(--rc-sidebar-hover);
    }

    .sidebar .nav-link.active {
        background: var(--rc-sidebar-active);
        font-weight: 700;
    }

    .main-content {
        flex: 1;
        min-width: 0;
        padding: 2rem 2.25rem;
    }

    .page-title {
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .panel {
        background: #fff;
        border: 0;
        border-radius: 0.9rem;
        box-shadow: 0 0.35rem 1.2rem rgba(31, 45, 61, 0.08);
    }

    .btn-primary {
        --bs-btn-bg: var(--rc-primary);
        --bs-btn-border-color: var(--rc-primary);
        --bs-btn-hover-bg: var(--rc-primary-hover);
        --bs-btn-hover-border-color: var(--rc-primary-hover);
        --bs-btn-active-bg: var(--rc-primary-hover);
        --bs-btn-active-border-color: var(--rc-primary-hover);
        border-radius: 0.55rem;
    }

    .btn-secondary {
        --bs-btn-bg: #8a8f94;
        --bs-btn-border-color: #8a8f94;
        --bs-btn-hover-bg: #74797e;
        --bs-btn-hover-border-color: #74797e;
        --bs-btn-active-bg: #74797e;
        --bs-btn-active-border-color: #74797e;
        border-radius: 0.55rem;
    }

    .form-label {
        font-size: 0.92rem;
        font-weight: 600;
    }

    .form-control,
    .form-select {
        border-radius: 0.55rem;
        padding: 0.6rem 0.85rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--rc-primary);
        box-shadow: 0 0 0 0.2rem rgba(63, 169, 230, 0.18);
    }

    .required-mark {
        color: #dc3545;
    }

    .table thead th {
        color: #6c757d;
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
        border-bottom: 1px solid #e6eaee;
    }

    .table tbody td {
        vertical-align: middle;
        white-space: nowrap;
        border-color: #eef1f4;
    }

    .table tbody tr:hover {
        background: #f8fbfd;
    }

    .status-badge {
        padding: 0.45em 0.8em;
        border: 1px solid transparent;
        border-radius: 50rem;
        font-weight: 600;
    }

    .status-disponible {
        background: #e7f6ec;
        color: #157347;
        border-color: #badbcc;
    }

    .status-alquilado,
    .status-pendiente {
        background: #fff3cd;
        color: #997404;
        border-color: #ffe69c;
    }

    .status-devuelto {
        background: #e2f0fb;
        color: #0a58ca;
        border-color: #b6d4fe;
    }

    .status-mantenimiento {
        background: #ffe8d6;
        color: #b45309;
        border-color: #ffd0a8;
    }

    .status-retrasado {
        background: #fde2e1;
        color: #b02a37;
        border-color: #f5c2c7;
    }

    .status-baja {
        background: #e9ecef;
        color: #495057;
        border-color: #ced4da;
    }

    .status-neutro {
        background: #eef1f4;
        color: #495057;
        border-color: #dee2e6;
    }

    .action-btn {
        border-radius: 50rem;
        font-weight: 600;
        box-shadow: 0 0.15rem 0.35rem rgba(31, 45, 61, 0.12);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 0.3rem 0.6rem rgba(31, 45, 61, 0.18);
    }

    .detail-label {
        color: #6c757d;
        font-weight: 400;
    }

    .detail-value {
        font-weight: 600;
    }

    .status-hero {
        border: 1px solid;
        box-shadow: 0 0.35rem 1.2rem rgba(31, 45, 61, 0.06);
    }

    .status-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        flex-shrink: 0;
        border-radius: 0.9rem;
        background: rgba(255, 255, 255, 0.65);
        font-size: 1.4rem;
    }

    .dashboard-card {
        display: block;
        color: inherit;
        text-decoration: none;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .dashboard-card:hover {
        color: inherit;
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1.5rem rgba(31, 45, 61, 0.14);
    }

    .dashboard-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        flex-shrink: 0;
        border-radius: 0.9rem;
        font-size: 1.4rem;
    }

    @media (max-width: 991.98px) {
        .app-shell {
            flex-direction: column;
        }

        .sidebar {
            width: 100%;
            padding: 1rem;
        }

        .sidebar .brand {
            padding-bottom: 0.75rem;
        }

        .sidebar .nav {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0.25rem;
        }

        .sidebar .nav-link {
            margin-bottom: 0;
        }

        .main-content {
            padding: 1.25rem;
        }
    }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar d-flex flex-column">
            <a class="brand" href="{{ route('home') }}">Renta<br>Car</a>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Panel</a>

                @if(auth()->user()->hasRole('administrador'))
                    <a class="nav-link {{ request()->routeIs('oficina.*') ? 'active' : '' }}" href="{{ route('oficina.index') }}" @if(request()->routeIs('oficina.*')) aria-current="page" @endif>Oficinas</a>
                @endif

                <a class="nav-link {{ request()->routeIs('coche.*') ? 'active' : '' }}" href="{{ route('coche.index') }}" @if(request()->routeIs('coche.*')) aria-current="page" @endif>Coches</a>
                <a class="nav-link {{ request()->routeIs('cliente.*') ? 'active' : '' }}" href="{{ route('cliente.index') }}" @if(request()->routeIs('cliente.*')) aria-current="page" @endif>Clientes</a>
                <a class="nav-link {{ request()->routeIs('alquiler.*') ? 'active' : '' }}" href="{{ route('alquiler.index') }}" @if(request()->routeIs('alquiler.*')) aria-current="page" @endif>Alquileres</a>

                @if(auth()->user()->hasRole('administrador'))
                    <a class="nav-link {{ request()->routeIs('usuario.*') ? 'active' : '' }}" href="{{ route('usuario.index') }}" @if(request()->routeIs('usuario.*')) aria-current="page" @endif>Usuarios</a>
                @endif
            </nav>

            <div class="mt-auto pt-3">
                <div class="px-2 mb-2 small">
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-muted">{{ auth()->user()->username }} · {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'Sin rol') }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                        <i class="bi bi-box-arrow-right me-1"></i>Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Oficinas</h1>
                <a href="{{ route('oficina.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nueva Oficina
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row g-2 align-items-end mb-3">
                <div class="col-12 col-lg-8">
                    <label for="filtroTexto" class="form-label small text-muted mb-1">Buscar oficina</label>
                    <input type="text" id="filtroTexto" class="form-control" placeholder="Código, ciudad o calle">
                </div>
                <div class="col-12 col-lg-4">
                    <div class="d-flex gap-2">
                        <button type="button" id="btnFiltrar" class="btn btn-primary flex-fill">
                            <i class="bi bi-funnel me-1"></i>Filtrar
                        </button>
                        <button type="button" id="btnLimpiar" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <div class="panel p-3 p-md-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tablaOficinas">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Calle</th>
                                <th scope="col">Número</th>
                                <th scope="col">Código postal</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($oficinas as $oficina)
                                <tr data-codigo="{{ $oficina->codigo_oficina }}" data-ciudad="{{ $oficina->ciudad }}" data-calle="{{ $oficina->calle }}">
                                    <td class="fw-semibold">{{ $oficina->codigo_oficina }}</td>
                                    <td>{{ $oficina->ciudad }}</td>
                                    <td>{{ $oficina->calle }}</td>
                                    <td>{{ $oficina->numero }}</td>
                                    <td>{{ $oficina->codigo_postal }}</td>
                                    <td>{{ $oficina->telefono }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('oficina.show', $oficina->id) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('oficina.edit', $oficina->id) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('oficina.destroy', $oficina->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta oficina?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No hay oficinas registradas. <a href="{{ route('oficina.create') }}">Crea la primera</a>.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="sinResultados" class="d-none">
                                <td colspan="7" class="text-center text-muted py-4">No hay oficinas que coincidan con los filtros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
