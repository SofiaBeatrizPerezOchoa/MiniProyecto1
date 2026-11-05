<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Oficina</title>
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
                <a class="nav-link active" href="{{ route('oficina.index') }}" aria-current="page">Oficinas</a>
                <a class="nav-link" href="{{ route('coche.index') }}">Coches</a>
                <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                <a class="nav-link" href="{{ route('alquiler.index') }}">Alquileres</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Nueva Oficina</h1>
                    <p class="text-muted mb-0">Completa los datos para registrar una oficina.</p>
                </div>
                <a href="{{ route('oficina.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
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
                <form action="{{ route('oficina.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="codigo_oficina" class="form-label">Código de oficina <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_oficina" name="codigo_oficina" value="{{ old('codigo_oficina') }}" class="form-control @error('codigo_oficina') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código" required>
                            @error('codigo_oficina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="ciudad" class="form-label">Ciudad <span class="required-mark">*</span></label>
                            <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}" class="form-control @error('ciudad') is-invalid @enderror" maxlength="50" placeholder="Ingrese la ciudad" required>
                            @error('ciudad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="calle" class="form-label">Calle <span class="required-mark">*</span></label>
                            <input type="text" id="calle" name="calle" value="{{ old('calle') }}" class="form-control @error('calle') is-invalid @enderror" maxlength="100" placeholder="Ingrese la calle" required>
                            @error('calle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero" class="form-label">Número <span class="required-mark">*</span></label>
                            <input type="number" id="numero" name="numero" value="{{ old('numero') }}" class="form-control @error('numero') is-invalid @enderror" min="0" step="1" placeholder="Ingrese el número" required>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="codigo_postal" class="form-label">Código postal <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}" class="form-control @error('codigo_postal') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código postal" required>
                            @error('codigo_postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono <span class="required-mark">*</span></label>
                            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" maxlength="20" placeholder="Ingrese el teléfono" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar Oficina</button>
                        <a href="{{ route('oficina.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
