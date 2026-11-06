@extends('layouts.app')

@section('title', 'Crear Cliente')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Nuevo Cliente</h1>
                    <p class="text-muted mb-0">Completa los datos para registrar un cliente.</p>
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
                <form action="{{ route('cliente.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="DNI" class="form-label">DNI <span class="required-mark">*</span></label>
                            <input type="text" id="DNI" name="DNI" value="{{ old('DNI') }}" class="form-control @error('DNI') is-invalid @enderror" maxlength="13" placeholder="Ingrese el DNI" required>
                            @error('DNI')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="nombre" class="form-label">Nombre Completo <span class="required-mark">*</span></label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror" maxlength="120" placeholder="Ingrese el nombre completo" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="direccion" class="form-label">Dirección <span class="required-mark">*</span></label>
                            <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="form-control @error('direccion') is-invalid @enderror" maxlength="100" placeholder="Ingrese la dirección" required>
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="telefono" class="form-label">Teléfono <span class="required-mark">*</span></label>
                            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror" maxlength="8" placeholder="Ingrese el teléfono" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="tarjeta_credito" class="form-label">Tarjeta de Crédito</label>
                            <input type="text" id="tarjeta_credito" name="tarjeta_credito" value="{{ old('tarjeta_credito') }}" class="form-control @error('tarjeta_credito') is-invalid @enderror" maxlength="16" placeholder="Número de tarjeta">
                            @error('tarjeta_credito')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar Cliente</button>
                        <a href="{{ route('cliente.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        
@endsection
