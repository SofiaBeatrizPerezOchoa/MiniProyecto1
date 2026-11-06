@extends('layouts.app')

@section('title', 'Detalle del Cliente')

@section('content')
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
        
@endsection
