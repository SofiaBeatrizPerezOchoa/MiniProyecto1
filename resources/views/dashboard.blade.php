@extends('layouts.app')

@section('title', 'Panel')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="page-title h2 mb-1">Bienvenido a RENTA CAR</h1>
            <p class="text-muted mb-0">
                Hola, {{ auth()->user()->name }}. Este es el panel de gestión del sistema.
            </p>
        </div>
        <span class="badge rounded-pill text-bg-primary px-3 py-2">
            Rol: {{ ucfirst(auth()->user()->getRoleNames()->first() ?? 'Sin rol') }}
        </span>
    </div>

    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-4">
            <a href="{{ route('cliente.index') }}" class="panel dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <span class="dashboard-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Clientes</div>
                        <div class="fs-3 fw-bold">{{ $contadores['clientes'] }}</div>
                    </div>
                    <i class="bi bi-arrow-right ms-auto text-muted"></i>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <a href="{{ route('coche.index') }}" class="panel dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <span class="dashboard-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-car-front"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Coches</div>
                        <div class="fs-3 fw-bold">{{ $contadores['coches'] }}</div>
                    </div>
                    <i class="bi bi-arrow-right ms-auto text-muted"></i>
                </div>
            </a>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <a href="{{ route('alquiler.index') }}" class="panel dashboard-card h-100">
                <div class="card-body d-flex align-items-center gap-3 p-4">
                    <span class="dashboard-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-calendar-check"></i>
                    </span>
                    <div>
                        <div class="text-muted small">Alquileres</div>
                        <div class="fs-3 fw-bold">{{ $contadores['alquileres'] }}</div>
                    </div>
                    <i class="bi bi-arrow-right ms-auto text-muted"></i>
                </div>
            </a>
        </div>

        @if(auth()->user()->hasRole('administrador'))
            <div class="col-12 col-sm-6 col-xl-4">
                <a href="{{ route('oficina.index') }}" class="panel dashboard-card h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <span class="dashboard-icon bg-info bg-opacity-10 text-info">
                            <i class="bi bi-shop"></i>
                        </span>
                        <div>
                            <div class="text-muted small">Oficinas</div>
                            <div class="fs-3 fw-bold">{{ $contadores['oficinas'] }}</div>
                        </div>
                        <i class="bi bi-arrow-right ms-auto text-muted"></i>
                    </div>
                </a>
            </div>

            <div class="col-12 col-sm-6 col-xl-4">
                <a href="{{ route('usuario.index') }}" class="panel dashboard-card h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-4">
                        <span class="dashboard-icon bg-secondary bg-opacity-10 text-secondary">
                            <i class="bi bi-person-gear"></i>
                        </span>
                        <div>
                            <div class="text-muted small">Usuarios</div>
                            <div class="fs-3 fw-bold">{{ $contadores['usuarios'] }}</div>
                        </div>
                        <i class="bi bi-arrow-right ms-auto text-muted"></i>
                    </div>
                </a>
            </div>
        @endif
    </div>
@endsection
