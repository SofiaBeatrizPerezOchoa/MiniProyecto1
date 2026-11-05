<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Coches</title>
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

        .status-alquilado {
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
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('home') }}">Renta<br>Car</a>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('home') }}">Panel</a>
                <a class="nav-link" href="{{ route('oficina.index') }}">Oficinas</a>
                <a class="nav-link active" href="{{ route('coche.index') }}" aria-current="page">Coches</a>
                <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                <a class="nav-link" href="{{ route('alquiler.index') }}">Alquileres</a>
            </nav>
        </aside>

        <main class="main-content">
            @php
                $gruposDisponibles = collect(['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F'])
                    ->merge($coches->pluck('grupo'))
                    ->filter()
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Coches</h1>
                <a href="{{ route('coche.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nuevo Coche
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row g-2 align-items-end mb-3">
                <div class="col-12 col-lg-6">
                    <label for="filtroTexto" class="form-label small text-muted mb-1">Buscar coche</label>
                    <input type="text" id="filtroTexto" class="form-control" placeholder="Matrícula, marca o modelo">
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="filtroGrupo" class="form-label small text-muted mb-1">Grupo</label>
                    <select id="filtroGrupo" class="form-select">
                        <option value="">Todos los grupos</option>
                        @foreach($gruposDisponibles as $grupo)
                            <option value="{{ $grupo }}">{{ $grupo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-lg-3">
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
                    <table class="table table-hover align-middle mb-0" id="tablaCoches">
                        <thead>
                            <tr>
                                <th scope="col">Matrícula</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Puertas</th>
                                <th scope="col">Plazas</th>
                                <th scope="col">Maletero</th>
                                <th scope="col">Edad mínima</th>
                                <th scope="col">Oficina</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coches as $coche)
                                @php
                                    $estado = mb_strtolower(trim($coche->estado));
                                    $estadoClase = match ($estado) {
                                        'disponible' => 'status-disponible',
                                        'alquilado' => 'status-alquilado',
                                        'devuelto' => 'status-devuelto',
                                        'en mantenimiento' => 'status-mantenimiento',
                                        'retrasado' => 'status-retrasado',
                                        'en baja' => 'status-baja',
                                        default => 'status-neutro',
                                    };
                                @endphp
                                <tr data-matricula="{{ $coche->matricula }}" data-marca="{{ $coche->marca }}" data-modelo="{{ $coche->modelo }}" data-grupo="{{ $coche->grupo }}">
                                    <td class="fw-semibold">{{ $coche->matricula }}</td>
                                    <td>{{ $coche->grupo }}</td>
                                    <td>{{ $coche->marca }}</td>
                                    <td>{{ $coche->modelo }}</td>
                                    <td>{{ $coche->numero_puertas }}</td>
                                    <td>{{ $coche->numero_plazas }}</td>
                                    <td>{{ $coche->capacidad_maletero }} L</td>
                                    <td>{{ $coche->edad_minima }}</td>
                                    <td>{{ $coche->codigo_oficina }}</td>
                                    <td>
                                        <span class="badge status-badge {{ $estadoClase }}">{{ $coche->estado }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('coche.show', $coche->id) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('coche.edit', $coche->id) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('coche.destroy', $coche->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este coche?')">
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
                                    <td colspan="11" class="text-center text-muted py-4">
                                        No hay coches registrados. <a href="{{ route('coche.create') }}">Crea el primero</a>.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="sinResultados" class="d-none">
                                <td colspan="11" class="text-center text-muted py-4">No hay coches que coincidan con los filtros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        (function () {
            const filtroTexto = document.getElementById('filtroTexto');
            const filtroGrupo = document.getElementById('filtroGrupo');
            const btnFiltrar = document.getElementById('btnFiltrar');
            const btnLimpiar = document.getElementById('btnLimpiar');
            const filas = Array.from(document.querySelectorAll('#tablaCoches tbody tr[data-matricula]'));
            const sinResultados = document.getElementById('sinResultados');

            if (!filtroTexto || !filtroGrupo || !btnFiltrar) {
                return;
            }

            function normalizar(valor) {
                return (valor || '').toLowerCase().trim();
            }

            function filtrar() {
                const texto = normalizar(filtroTexto.value);
                const grupo = filtroGrupo.value;
                let visibles = 0;

                filas.forEach(function (fila) {
                    const coincideTexto = !texto || [fila.dataset.matricula, fila.dataset.marca, fila.dataset.modelo].some(function (valor) {
                        return normalizar(valor).includes(texto);
                    });
                    const coincideGrupo = !grupo || fila.dataset.grupo === grupo;
                    const visible = coincideTexto && coincideGrupo;

                    fila.classList.toggle('d-none', !visible);

                    if (visible) {
                        visibles++;
                    }
                });

                if (sinResultados) {
                    sinResultados.classList.toggle('d-none', visibles !== 0 || filas.length === 0);
                }
            }

            function limpiar() {
                filtroTexto.value = '';
                filtroGrupo.value = '';
                filtrar();
                filtroTexto.focus();
            }

            btnFiltrar.addEventListener('click', filtrar);
            filtroGrupo.addEventListener('change', filtrar);
            filtroTexto.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    filtrar();
                }
            });

            if (btnLimpiar) {
                btnLimpiar.addEventListener('click', limpiar);
            }
        })();
    </script>
</body>
</html>
