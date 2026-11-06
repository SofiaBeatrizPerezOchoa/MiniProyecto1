@extends('layouts.app')

@section('title', 'Detalle de la Oficina')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Detalle de la Oficina</h1>
                    <p class="text-muted mb-0">{{ $oficina->ciudad }} · {{ $oficina->calle }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('oficina.edit', $oficina->id) }}" class="btn btn-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>Editar
                    </a>
                    <a href="{{ route('oficina.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Volver al listado
                    </a>
                </div>
            </div>

            <div class="status-hero status-devuelto rounded-4 p-3 p-md-4 mb-4">
                <div class="d-flex align-items-center gap-3">
                    <span class="status-icon"><i class="bi bi-shop"></i></span>
                    <div>
                        <div class="small text-uppercase fw-semibold opacity-75">Código de oficina</div>
                        <div class="fs-4 fw-bold">{{ $oficina->codigo_oficina }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="panel p-4 h-100">
                        <h2 class="h5 fw-bold mb-3">Ubicación</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-4 detail-label mb-0">Ciudad</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $oficina->ciudad }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Calle</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $oficina->calle }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Número</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $oficina->numero }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Código postal</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $oficina->codigo_postal }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="panel p-4 h-100">
                        <h2 class="h5 fw-bold mb-3">Contacto</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-5 detail-label mb-0">Teléfono</dt>
                            <dd class="col-sm-7 detail-value mb-0">{{ $oficina->telefono }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        
@endsection
