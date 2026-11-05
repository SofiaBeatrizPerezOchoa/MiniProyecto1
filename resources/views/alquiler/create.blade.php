<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Alquiler</title>
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
                <a class="nav-link" href="{{ route('coche.index') }}">Coches</a>
                <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                <a class="nav-link active" href="{{ route('alquiler.index') }}" aria-current="page">Alquileres</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Nuevo Alquiler</h1>
                    <p class="text-muted mb-0">Completa los datos para registrar un alquiler.</p>
                </div>
                <a href="{{ route('alquiler.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
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
                <form id="formAlquiler" action="{{ route('alquiler.store') }}" method="POST">
                    @csrf

                    @php
                        $segurosDisponibles = ['Básico', 'Completo', 'Premium', 'Sin seguro'];
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
                            <label for="dni" class="form-label">DNI del cliente <span class="required-mark">*</span></label>
                            <input type="text" id="dni" name="dni" value="{{ old('dni') }}" class="form-control @error('dni') is-invalid @enderror" maxlength="13" minlength="13" inputmode="numeric" pattern="[0-9]{13}" placeholder="Ingrese 13 dígitos" required>
                            <div class="form-text">Debe contener exactamente 13 dígitos.</div>
                            @error('dni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="tipo_seguro" class="form-label">Tipo de seguro <span class="required-mark">*</span></label>
                            <select id="tipo_seguro" name="tipo_seguro" class="form-select @error('tipo_seguro') is-invalid @enderror" required>
                                <option value="" disabled @selected(!old('tipo_seguro'))>Seleccione un seguro</option>
                                @foreach($segurosDisponibles as $seguro)
                                    <option value="{{ $seguro }}" @selected(old('tipo_seguro') === $seguro)>{{ $seguro }}</option>
                                @endforeach
                            </select>
                            @error('tipo_seguro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio <span class="required-mark">*</span></label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" class="form-control @error('fecha_inicio') is-invalid @enderror" required>
                            @error('fecha_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_devolucion_prevista" class="form-label">Devolución prevista <span class="required-mark">*</span></label>
                            <input type="date" id="fecha_devolucion_prevista" name="fecha_devolucion_prevista" value="{{ old('fecha_devolucion_prevista') }}" class="form-control @error('fecha_devolucion_prevista') is-invalid @enderror" required>
                            @error('fecha_devolucion_prevista')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_devolucion_real" class="form-label">Devolución real</label>
                            <input type="date" id="fecha_devolucion_real" name="fecha_devolucion_real" value="{{ old('fecha_devolucion_real') }}" class="form-control @error('fecha_devolucion_real') is-invalid @enderror">
                            <div class="form-text">Opcional. Déjala vacía si el coche aún no se ha devuelto.</div>
                            @error('fecha_devolucion_real')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="duracion_dias" class="form-label">Duración en días <span class="required-mark">*</span></label>
                            <input type="number" id="duracion_dias" name="duracion_dias" value="{{ old('duracion_dias') }}" class="form-control @error('duracion_dias') is-invalid @enderror" min="1" step="1" placeholder="Ingrese la duración" required>
                            @error('duracion_dias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="precio_total" class="form-label">Precio total <span class="required-mark">*</span></label>
                            <input type="number" id="precio_total" name="precio_total" value="{{ old('precio_total') }}" class="form-control @error('precio_total') is-invalid @enderror" min="0" step="0.01" placeholder="0.00" required>
                            @error('precio_total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="recargo" class="form-label">Recargo <span class="required-mark">*</span></label>
                            <input type="number" id="recargo" name="recargo" value="{{ old('recargo') }}" class="form-control @error('recargo') is-invalid @enderror" min="0" step="0.01" placeholder="0.00" required>
                            @error('recargo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar Alquiler</button>
                        <button type="button" id="btnLimpiarFormulario" class="btn btn-outline-secondary px-4">Limpiar</button>
                        <a href="{{ route('alquiler.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        (function () {
            const formulario = document.getElementById('formAlquiler');
            const btnLimpiar = document.getElementById('btnLimpiarFormulario');

            if (!formulario || !btnLimpiar) {
                return;
            }

            btnLimpiar.addEventListener('click', function () {
                Array.from(formulario.elements).forEach(function (elemento) {
                    if (elemento.tagName === 'SELECT') {
                        elemento.value = '';
                    } else if (elemento.tagName === 'INPUT') {
                        elemento.value = '';
                    }

                    elemento.classList.remove('is-invalid');
                });

                const primero = formulario.querySelector('input, select');
                if (primero) {
                    primero.focus();
                }
            });
        })();
    </script>
</body>
</html>
