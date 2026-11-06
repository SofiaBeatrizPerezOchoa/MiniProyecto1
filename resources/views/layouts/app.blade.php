<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Renta Car') | Renta Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @include('layouts.partials.theme')
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
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
