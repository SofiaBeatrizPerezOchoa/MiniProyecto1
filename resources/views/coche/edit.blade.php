<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Coche | Renta Car</title>
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
                <div>
                    <h1 class="page-title h2 mb-1">Editar Coche</h1>
                    <p class="text-muted mb-0">Modifica los datos del coche seleccionado.</p>
                </div>
                <a href="{{ route('coche.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="fw-semibold mb-2">Revisa los siguientes campos:</p>
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="panel p-4">
                <form action="{{ route('coche.update', $coche->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        $grupoActual = old('grupo', $coche->grupo);
                        $estadoActual = old('estado', $coche->estado);
                        $gruposDisponibles = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F'];
                        $estadosDisponibles = ['Disponible', 'Alquilado', 'Devuelto', 'En Mantenimiento', 'Retrasado', 'En baja'];

                        if ($grupoActual && ! in_array($grupoActual, $gruposDisponibles, true)) {
                            $gruposDisponibles[] = $grupoActual;
                        }

                        if ($estadoActual && ! in_array($estadoActual, $estadosDisponibles, true)) {
                            $estadosDisponibles[] = $estadoActual;
                        }
                    @endphp

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="matricula" class="form-label">Matrícula <span class="required-mark">*</span></label>
                            <input type="text" id="matricula" name="matricula" value="{{ old('matricula', $coche->matricula) }}" class="form-control @error('matricula') is-invalid @enderror" maxlength="20" placeholder="Ingrese la matrícula" required>
                            @error('matricula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="modelo" class="form-label">Modelo <span class="required-mark">*</span></label>
                            <input type="text" id="modelo" name="modelo" value="{{ old('modelo', $coche->modelo) }}" class="form-control @error('modelo') is-invalid @enderror" maxlength="50" placeholder="Ingrese el modelo" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="capacidad_maletero" class="form-label">Capacidad del maletero <span class="required-mark">*</span></label>
                            <input type="number" id="capacidad_maletero" name="capacidad_maletero" value="{{ old('capacidad_maletero', $coche->capacidad_maletero) }}" class="form-control @error('capacidad_maletero') is-invalid @enderror" min="0" step="1" placeholder="Capacidad en litros" required>
                            <div class="form-text">Indica la capacidad del maletero en litros.</div>
                            @error('capacidad_maletero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="grupo" class="form-label">Grupo <span class="required-mark">*</span></label>
                            <select id="grupo" name="grupo" class="form-select @error('grupo') is-invalid @enderror" required>
                                <option value="" disabled @selected(! $grupoActual)>Seleccione un grupo</option>
                                @foreach($gruposDisponibles as $grupo)
                                    <option value="{{ $grupo }}" @selected($grupoActual === $grupo)>{{ $grupo }}</option>
                                @endforeach
                            </select>
                            @error('grupo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_puertas" class="form-label">Número de puertas <span class="required-mark">*</span></label>
                            <input type="number" id="numero_puertas" name="numero_puertas" value="{{ old('numero_puertas', $coche->numero_puertas) }}" class="form-control @error('numero_puertas') is-invalid @enderror" min="1" step="1" placeholder="Ingrese el número" required>
                            @error('numero_puertas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="codigo_oficina" class="form-label">Código de oficina <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_oficina" name="codigo_oficina" value="{{ old('codigo_oficina', $coche->codigo_oficina) }}" class="form-control @error('codigo_oficina') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código" required>
                            @error('codigo_oficina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="marca" class="form-label">Marca <span class="required-mark">*</span></label>
                            <input type="text" id="marca" name="marca" value="{{ old('marca', $coche->marca) }}" class="form-control @error('marca') is-invalid @enderror" maxlength="50" placeholder="Ingrese marca" required>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_plazas" class="form-label">Número de plazas <span class="required-mark">*</span></label>
                            <input type="number" id="numero_plazas" name="numero_plazas" value="{{ old('numero_plazas', $coche->numero_plazas) }}" class="form-control @error('numero_plazas') is-invalid @enderror" min="1" step="1" placeholder="Ingrese las plazas" required>
                            @error('numero_plazas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="estado" class="form-label">Estado <span class="required-mark">*</span></label>
                            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="" disabled @selected(! $estadoActual)>Seleccione un estado</option>
                                @foreach($estadosDisponibles as $estado)
                                    <option value="{{ $estado }}" @selected($estadoActual === $estado)>{{ $estado }}</option>
                                @endforeach
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="edad_minima" class="form-label">Edad mínima <span class="required-mark">*</span></label>
                            <input type="number" id="edad_minima" name="edad_minima" value="{{ old('edad_minima', $coche->edad_minima) }}" class="form-control @error('edad_minima') is-invalid @enderror" min="0" step="1" placeholder="Ingrese la edad mínima" required>
                            @error('edad_minima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                        <a href="{{ route('coche.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
