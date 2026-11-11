<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario | Renta Car</title>
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
        <div>
            <h1 class="page-title h2 mb-1">Nuevo Usuario</h1>
            <p class="text-muted mb-0">Completa los datos para registrar un usuario.</p>
        </div>
        <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
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
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nombre completo <span class="required-mark">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" maxlength="255" placeholder="Ingrese el nombre completo" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="username" class="form-label">Usuario <span class="required-mark">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" maxlength="50" placeholder="Se genera desde el nombre" autocomplete="off">
                    <div class="form-text">Se genera automáticamente desde el nombre. Puede editarlo; debe ser único.</div>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label">Contraseña <span class="required-mark">*</span></label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmación de contraseña <span class="required-mark">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita la contraseña" autocomplete="new-password" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="rol" class="form-label">Tipo de usuario <span class="required-mark">*</span></label>
                    <select id="rol" name="rol" class="form-select @error('rol') is-invalid @enderror" required>
                        <option value="">Seleccione un tipo de usuario</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol }}" @selected(old('rol') === $rol)>{{ ucfirst($rol) }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="form-check mt-4">
                        <input type="hidden" name="activo" value="0">
                        <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" @checked(old('activo', true))>
                        <label class="form-check-label" for="activo">Usuario activo</label>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-primary px-4">Guardar Usuario</button>
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
        </main>
    </div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            const usernameInput = document.getElementById('username');

            if (!nameInput || !usernameInput) {
                return;
            }

            const usernames = @json($usernames);
            let usernameEdited = usernameInput.value.trim() !== '';

            const palabras = (texto) => texto
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
                .split(/\s+/)
                .filter(Boolean);

            const limpiar = (texto) => texto.replace(/[^a-z0-9._-]/g, '').slice(0, 50);

            const disponible = (base) => {
                let candidato = limpiar(base) || 'usuario';
                let sufijo = 2;

                while (usernames.includes(candidato)) {
                    const texto = String(sufijo++);
                    candidato = `${candidato.slice(0, 50 - texto.length)}${texto}`;
                }

                return candidato;
            };

            const generar = (nombre) => {
                const partes = palabras(nombre);

                if (partes.length === 0) {
                    return '';
                }

                const primerNombre = partes[0];

                if (partes.length === 1) {
                    return disponible(primerNombre);
                }

                const primerApellido = partes.length >= 3
                    ? partes[partes.length - 2]
                    : partes[partes.length - 1];

                const base = limpiar(primerNombre.charAt(0) + primerApellido);

                if (!usernames.includes(base)) {
                    return base;
                }

                return disponible(primerNombre + primerApellido.charAt(0));
            };

            usernameInput.addEventListener('input', () => {
                usernameEdited = true;
            });

            nameInput.addEventListener('input', () => {
                if (!usernameEdited) {
                    usernameInput.value = generar(nameInput.value);
                }
            });

            if (!usernameEdited && nameInput.value.trim() !== '') {
                usernameInput.value = generar(nameInput.value);
            }
        });
    </script>
@endpush

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
