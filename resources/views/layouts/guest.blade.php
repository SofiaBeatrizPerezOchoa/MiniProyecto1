<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Iniciar sesión') | Renta Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @include('layouts.partials.theme')
    <style>
        .guest-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .guest-card {
            width: 100%;
            max-width: 420px;
        }

        .guest-brand {
            color: var(--rc-primary);
            font-size: 1.5rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            text-decoration: none;
        }
    </style>
    @stack('styles')
</head>
<body>
    <main class="guest-shell">
        <div class="guest-card">
            <div class="text-center mb-4">
                <a class="guest-brand" href="{{ route('login') }}">Renta Car</a>
                <p class="text-muted mb-0 mt-1">Sistema de gestión de alquiler de coches</p>
            </div>

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
