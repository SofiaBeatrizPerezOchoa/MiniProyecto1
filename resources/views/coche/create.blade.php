<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Coche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Nuevo Coche</h1>
                    <p class="text-muted mb-0">Completa los datos para registrar un coche en la flota.</p>
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
                <form action="{{ route('coche.store') }}" method="POST">
                    @csrf

                    @php
                        $gruposDisponibles = ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F'];
                        $estadosDisponibles = ['Disponible', 'Alquilado', 'Devuelto', 'En Mantenimiento', 'Retrasado', 'En baja'];
                    @endphp

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="matricula" class="form-label">Matrícula <span class="required-mark">*</span></label>
                            <input type="text" id="matricula" name="matricula" value="{{ old('matricula') }}" class="form-control @error('matricula') is-invalid @enderror" maxlength="20" placeholder="Ingrese la matrícula" required>
                            @error('matricula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="modelo" class="form-label">Modelo <span class="required-mark">*</span></label>
                            <input type="text" id="modelo" name="modelo" value="{{ old('modelo') }}" class="form-control @error('modelo') is-invalid @enderror" maxlength="50" placeholder="Ingrese el modelo" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="capacidad_maletero" class="form-label">Capacidad del maletero <span class="required-mark">*</span></label>
                            <input type="number" id="capacidad_maletero" name="capacidad_maletero" value="{{ old('capacidad_maletero') }}" class="form-control @error('capacidad_maletero') is-invalid @enderror" min="0" step="1" placeholder="Capacidad en litros" required>
                            <div class="form-text">Indica la capacidad del maletero en litros.</div>
                            @error('capacidad_maletero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="grupo" class="form-label">Grupo <span class="required-mark">*</span></label>
                            <select id="grupo" name="grupo" class="form-select @error('grupo') is-invalid @enderror" required>
                                <option value="" disabled @selected(!old('grupo'))>Seleccione un grupo</option>
                                @foreach($gruposDisponibles as $grupo)
                                    <option value="{{ $grupo }}" @selected(old('grupo') === $grupo)>{{ $grupo }}</option>
                                @endforeach
                            </select>
                            @error('grupo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_puertas" class="form-label">Número de puertas <span class="required-mark">*</span></label>
                            <input type="number" id="numero_puertas" name="numero_puertas" value="{{ old('numero_puertas') }}" class="form-control @error('numero_puertas') is-invalid @enderror" min="1" step="1" placeholder="Ingrese el número" required>
                            @error('numero_puertas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="codigo_oficina" class="form-label">Código de oficina <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_oficina" name="codigo_oficina" value="{{ old('codigo_oficina') }}" class="form-control @error('codigo_oficina') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código" required>
                            @error('codigo_oficina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="marca" class="form-label">Marca <span class="required-mark">*</span></label>
                            <input type="text" id="marca" name="marca" value="{{ old('marca') }}" class="form-control @error('marca') is-invalid @enderror" maxlength="50" placeholder="Ingrese marca" required>
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero_plazas" class="form-label">Número de plazas <span class="required-mark">*</span></label>
                            <input type="number" id="numero_plazas" name="numero_plazas" value="{{ old('numero_plazas') }}" class="form-control @error('numero_plazas') is-invalid @enderror" min="1" step="1" placeholder="Ingrese las plazas" required>
                            @error('numero_plazas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="estado" class="form-label">Estado <span class="required-mark">*</span></label>
                            <select id="estado" name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="" disabled @selected(!old('estado'))>Seleccione un estado</option>
                                @foreach($estadosDisponibles as $estado)
                                    <option value="{{ $estado }}" @selected(old('estado') === $estado)>{{ $estado }}</option>
                                @endforeach
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="edad_minima" class="form-label">Edad mínima <span class="required-mark">*</span></label>
                            <input type="number" id="edad_minima" name="edad_minima" value="{{ old('edad_minima') }}" class="form-control @error('edad_minima') is-invalid @enderror" min="0" step="1" placeholder="Ingrese la edad mínima" required>
                            @error('edad_minima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar Coche</button>
                        <a href="{{ route('coche.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
