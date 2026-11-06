@extends('layouts.app')

@section('title', 'Editar Alquiler')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Editar Alquiler</h1>
                    <p class="text-muted mb-0">Modifica los datos del alquiler seleccionado.</p>
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
                <form id="formAlquiler" action="{{ route('alquiler.update', $alquiler->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @php
                        $seguroActual = old('tipo_seguro', $alquiler->tipo_seguro);
                        $segurosDisponibles = ['Básico', 'Completo', 'Premium', 'Sin seguro'];

                        if ($seguroActual && ! in_array($seguroActual, $segurosDisponibles, true)) {
                            $segurosDisponibles[] = $seguroActual;
                        }
                    @endphp

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="matricula" class="form-label">Matrícula <span class="required-mark">*</span></label>
                            <input type="text" id="matricula" name="matricula" value="{{ old('matricula', $alquiler->matricula) }}" class="form-control @error('matricula') is-invalid @enderror" maxlength="20" placeholder="Ingrese la matrícula" required>
                            @error('matricula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="dni" class="form-label">DNI del cliente <span class="required-mark">*</span></label>
                            <input type="text" id="dni" name="dni" value="{{ old('dni', $alquiler->dni) }}" class="form-control @error('dni') is-invalid @enderror" maxlength="13" minlength="13" inputmode="numeric" pattern="[0-9]{13}" placeholder="Ingrese 13 dígitos" required>
                            <div class="form-text">Debe contener exactamente 13 dígitos.</div>
                            @error('dni')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="tipo_seguro" class="form-label">Tipo de seguro <span class="required-mark">*</span></label>
                            <select id="tipo_seguro" name="tipo_seguro" class="form-select @error('tipo_seguro') is-invalid @enderror" required>
                                <option value="" disabled @selected(! $seguroActual)>Seleccione un seguro</option>
                                @foreach($segurosDisponibles as $seguro)
                                    <option value="{{ $seguro }}" @selected($seguroActual === $seguro)>{{ $seguro }}</option>
                                @endforeach
                            </select>
                            @error('tipo_seguro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio <span class="required-mark">*</span></label>
                            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $alquiler->fecha_inicio?->format('Y-m-d')) }}" class="form-control @error('fecha_inicio') is-invalid @enderror" required>
                            @error('fecha_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_devolucion_prevista" class="form-label">Devolución prevista <span class="required-mark">*</span></label>
                            <input type="date" id="fecha_devolucion_prevista" name="fecha_devolucion_prevista" value="{{ old('fecha_devolucion_prevista', $alquiler->fecha_devolucion_prevista?->format('Y-m-d')) }}" class="form-control @error('fecha_devolucion_prevista') is-invalid @enderror" required>
                            @error('fecha_devolucion_prevista')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="fecha_devolucion_real" class="form-label">Devolución real</label>
                            <input type="date" id="fecha_devolucion_real" name="fecha_devolucion_real" value="{{ old('fecha_devolucion_real', $alquiler->fecha_devolucion_real?->format('Y-m-d')) }}" class="form-control @error('fecha_devolucion_real') is-invalid @enderror">
                            <div class="form-text">Opcional. Déjala vacía si el coche aún no se ha devuelto.</div>
                            @error('fecha_devolucion_real')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="duracion_dias" class="form-label">Duración en días <span class="required-mark">*</span></label>
                            <input type="number" id="duracion_dias" name="duracion_dias" value="{{ old('duracion_dias', $alquiler->duracion_dias) }}" class="form-control @error('duracion_dias') is-invalid @enderror" min="1" step="1" placeholder="Ingrese la duración" required>
                            @error('duracion_dias')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="precio_total" class="form-label">Precio total <span class="required-mark">*</span></label>
                            <input type="number" id="precio_total" name="precio_total" value="{{ old('precio_total', $alquiler->precio_total) }}" class="form-control @error('precio_total') is-invalid @enderror" min="0" step="0.01" placeholder="0.00" required>
                            @error('precio_total')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="recargo" class="form-label">Recargo <span class="required-mark">*</span></label>
                            <input type="number" id="recargo" name="recargo" value="{{ old('recargo', $alquiler->recargo) }}" class="form-control @error('recargo') is-invalid @enderror" min="0" step="0.01" placeholder="0.00" required>
                            @error('recargo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                        <button type="button" id="btnLimpiarFormulario" class="btn btn-outline-secondary px-4">Limpiar</button>
                        <a href="{{ route('alquiler.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        
@endsection
