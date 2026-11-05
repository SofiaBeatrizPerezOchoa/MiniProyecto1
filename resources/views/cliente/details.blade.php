<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Cliente</title>
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

        .detail-label {
            color: #6c757d;
            font-weight: 400;
        }

        .detail-value {
            font-weight: 600;
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
                <a class="nav-link" href="{{ route('coche.index') }}">Coches</a>
                <a class="nav-link active" href="{{ route('cliente.index') }}" aria-current="page">Clientes</a>
                <a class="nav-link" href="{{ route('alquiler.index') }}">Alquileres</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Detalle del Cliente</h1>
                    <p class="text-muted mb-0">{{ $cliente->nombre }} · DNI: {{ $cliente->DNI }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('cliente.edit', $cliente->DNI) }}" class="btn btn-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>Editar
                    </a>
                    <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Volver al listado
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="panel p-4 h-100">
                        <h2 class="h5 fw-bold mb-3">Identificación</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-4 detail-label mb-0">DNI</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $cliente->DNI }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Nombre Completo</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $cliente->nombre }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Dirección</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $cliente->direccion }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Teléfono</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $cliente->telefono }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Tarjeta de Crédito</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $cliente->tarjeta_credito ?? 'No registrada' }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
