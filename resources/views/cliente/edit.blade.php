@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="page-title h2 mb-1">Editar Cliente</h1>
            <p class="text-muted mb-0">Modifica los datos del cliente seleccionado.</p>
        </div>
        <a href="{{ route('cliente.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
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
        <form action="{{ route('cliente.update', $cliente->DNI) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="DNI" value="{{ old('DNI', $cliente->DNI) }}">

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="nombre" class="form-label">Nombre Completo <span class="required-mark">*</span></label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control @error('nombre') is-invalid @enderror" maxlength="120" placeholder="Ingrese el nombre completo" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="direccion" class="form-label">Dirección <span class="required-mark">*</span></label>
                    <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" class="form-control @error('direccion') is-invalid @enderror" maxlength="100" placeholder="Ingrese la dirección" required>
                    @error('direccion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="telefono" class="form-label">Teléfono <span class="required-mark">*</span></label>
                    <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" maxlength="8" placeholder="Ingrese el teléfono" required>
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="tarjeta_credito" class="form-label">Tarjeta de Crédito</label>
                    <input type="text" id="tarjeta_credito" name="tarjeta_credito" value="{{ old('tarjeta_credito', $cliente->tarjeta_credito) }}" class="form-control @error('tarjeta_credito') is-invalid @enderror" maxlength="16" placeholder="Número de tarjeta">
                    @error('tarjeta_credito')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                <a href="{{ route('cliente.index') }}" class="btn btn-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
