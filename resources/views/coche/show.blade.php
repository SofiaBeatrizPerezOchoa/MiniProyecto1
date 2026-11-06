@extends('layouts.app')

@section('title', 'Detalle del Coche')

@section('content')
            @php
                $estado = mb_strtolower(trim($coche->estado));
                $estadoClase = match ($estado) {
                    'disponible' => 'status-disponible',
                    'alquilado' => 'status-alquilado',
                    'devuelto' => 'status-devuelto',
                    'en mantenimiento' => 'status-mantenimiento',
                    'retrasado' => 'status-retrasado',
                    'en baja' => 'status-baja',
                    default => 'status-neutro',
                };
                $estadoIcono = match ($estado) {
                    'disponible' => 'bi-check-circle',
                    'alquilado' => 'bi-key',
                    'devuelto' => 'bi-arrow-return-left',
                    'en mantenimiento' => 'bi-tools',
                    'retrasado' => 'bi-clock-history',
                    'en baja' => 'bi-x-circle',
                    default => 'bi-info-circle',
                };
            @endphp

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h1 class="page-title h2 mb-1">Detalle del Coche</h1>
                    <p class="text-muted mb-0">{{ $coche->marca }} {{ $coche->modelo }} · {{ $coche->matricula }}</p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('coche.edit', $coche->id) }}" class="btn btn-primary px-4">
                        <i class="bi bi-pencil-square me-1"></i>Editar
                    </a>
                    <a href="{{ route('coche.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left me-1"></i>Volver al listado
                    </a>
                </div>
            </div>

            <div class="status-hero {{ $estadoClase }} rounded-4 p-3 p-md-4 mb-4">
                <div class="d-flex align-items-center gap-3">
                    <span class="status-icon"><i class="bi {{ $estadoIcono }}"></i></span>
                    <div>
                        <div class="small text-uppercase fw-semibold opacity-75">Estado actual</div>
                        <div class="fs-4 fw-bold">{{ $coche->estado }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-lg-7">
                    <div class="panel p-4 h-100">
                        <h2 class="h5 fw-bold mb-3">Identificación</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-4 detail-label mb-0">Matrícula</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $coche->matricula }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Marca</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $coche->marca }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Modelo</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $coche->modelo }}</dd>

                            <dt class="col-sm-4 detail-label mb-0">Grupo</dt>
                            <dd class="col-sm-8 detail-value mb-0">{{ $coche->grupo }}</dd>
                        </dl>
                    </div>
                </div>

                <div class="col-12 col-lg-5">
                    <div class="panel p-4 mb-4">
                        <h2 class="h5 fw-bold mb-3">Características</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-7 detail-label mb-0">Número de puertas</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $coche->numero_puertas }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Número de plazas</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $coche->numero_plazas }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Capacidad del maletero</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $coche->capacidad_maletero }} L</dd>

                            <dt class="col-sm-7 detail-label mb-0">Edad mínima</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $coche->edad_minima }} años</dd>
                        </dl>
                    </div>

                    <div class="panel p-4">
                        <h2 class="h5 fw-bold mb-3">Disponibilidad</h2>
                        <dl class="row gy-3 mb-0">
                            <dt class="col-sm-7 detail-label mb-0">Código de oficina</dt>
                            <dd class="col-sm-5 detail-value mb-0">{{ $coche->codigo_oficina }}</dd>

                            <dt class="col-sm-7 detail-label mb-0">Estado</dt>
                            <dd class="col-sm-5 mb-0">
                                <span class="badge status-badge {{ $estadoClase }}">
                                    <i class="bi {{ $estadoIcono }} me-1"></i>{{ $coche->estado }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        
@endsection
