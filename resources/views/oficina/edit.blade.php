@extends('layouts.app')

@section('title', 'Editar Oficina')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Editar Oficina</h1>
                    <p class="text-muted mb-0">Modifica los datos de la oficina seleccionada.</p>
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
                <form action="{{ route('oficina.update', $oficina->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12 col-md-4">
                            <label for="codigo_oficina" class="form-label">Código de oficina <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_oficina" name="codigo_oficina" value="{{ old('codigo_oficina', $oficina->codigo_oficina) }}" class="form-control @error('codigo_oficina') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código" required>
                            @error('codigo_oficina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="ciudad" class="form-label">Ciudad <span class="required-mark">*</span></label>
                            <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad', $oficina->ciudad) }}" class="form-control @error('ciudad') is-invalid @enderror" maxlength="50" placeholder="Ingrese la ciudad" required>
                            @error('ciudad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="calle" class="form-label">Calle <span class="required-mark">*</span></label>
                            <input type="text" id="calle" name="calle" value="{{ old('calle', $oficina->calle) }}" class="form-control @error('calle') is-invalid @enderror" maxlength="100" placeholder="Ingrese la calle" required>
                            @error('calle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="numero" class="form-label">Número <span class="required-mark">*</span></label>
                            <input type="number" id="numero" name="numero" value="{{ old('numero', $oficina->numero) }}" class="form-control @error('numero') is-invalid @enderror" min="0" step="1" placeholder="Ingrese el número" required>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="codigo_postal" class="form-label">Código postal <span class="required-mark">*</span></label>
                            <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal', $oficina->codigo_postal) }}" class="form-control @error('codigo_postal') is-invalid @enderror" maxlength="10" placeholder="Ingrese el código postal" required>
                            @error('codigo_postal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="telefono" class="form-label">Teléfono <span class="required-mark">*</span></label>
                            <input type="tel" id="telefono" name="telefono" value="{{ old('telefono', $oficina->telefono) }}" class="form-control @error('telefono') is-invalid @enderror" maxlength="20" placeholder="Ingrese el teléfono" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                        <a href="{{ route('oficina.index') }}" class="btn btn-secondary px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        
@endsection
