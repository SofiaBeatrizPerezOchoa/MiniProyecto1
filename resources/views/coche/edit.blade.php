@extends('layouts.app')

@section('title', 'Editar Coche')

@section('content')
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
        
@endsection
