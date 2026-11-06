@extends('layouts.app')

@section('title', 'Detalle del Alquiler')

@section('content')
            @php
                $devuelto = $alquiler->fecha_devolucion_real !== null;
                $estadoTexto = $devuelto ? 'Devuelto' : 'Pendiente';
                $estadoClase = $devuelto ? 'status-devuelto' : 'status-pendiente';
                $estadoIcono = $devuelto ? 'bi-check-circle' : 'bi-clock-history';
            @endphp

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Detalle del Alquiler</h1>
                    <p class="text-muted mb-0">Alquiler #{{ $alquiler->id }} · {{ $alquiler->matricula }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>Editar
                    </a>
                    <a href="{{ route('alquiler.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Volver al listado
                    </a>
                </div>
            </div>

            <div class="status-hero {{ $estadoClase }} rounded-4 p-3 p-md-4 mb-4">
                <div class="d-flex align-items-center gap-3">
                    <span class="status-icon"><i class="bi {{ $estadoIcono }}"></i></span>
                    <div>
                        <div class="small text-uppercase fw-semibold opacity-75">Estado de devolución</div>
                        <div class="fs-4 fw-bold">{{ $estadoTexto }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="panel p-4 h-100">
                        <h2 class="h5 fw-bold mb-3">Datos del alquiler</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-4 detail-label mb-0">ID</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $alquiler->id }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Matrícula</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $alquiler->matricula }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">DNI del cliente</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $alquiler->dni }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Tipo de seguro</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $alquiler->tipo_seguro }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Estado</dt>
                            <dd class="col-sm-8 mb-0">
                                <span class="badge status-badge {{ $estadoClase }}">
                                    <i class="bi {{ $estadoIcono }} me-1"></i>{{ $estadoTexto }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="panel p-4 mb-4">
                        <h2 class="h5 fw-bold mb-3">Fechas</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-7 detail-label mb-0">Fecha de inicio</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $alquiler->fecha_inicio?->format('d/m/Y') }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Devolución prevista</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $alquiler->fecha_devolucion_prevista?->format('d/m/Y') }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Devolución real</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $alquiler->fecha_devolucion_real?->format('d/m/Y') ?? '—' }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Duración</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $alquiler->duracion_dias }} días</dd>
                        </dl>
                    </div>

                    <div class="panel p-4">
                        <h2 class="h5 fw-bold mb-3">Importes</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-7 detail-label mb-0">Precio total</dt>
                            <dd class="col-sm-5 detail-value mb-0">${{ number_format((float) $alquiler->precio_total, 2) }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Recargo</dt>
                            <dd class="col-sm-5 detail-value mb-0">${{ number_format((float) $alquiler->recargo, 2) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        
@endsection
