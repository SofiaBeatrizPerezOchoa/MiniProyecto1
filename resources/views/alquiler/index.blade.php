@extends('layouts.app')

@section('title', 'Lista de Alquileres')

@section('content')
            @php
                $segurosDisponibles = collect(['Básico', 'Completo', 'Premium', 'Sin seguro'])
                    ->merge($alquileres->pluck('tipo_seguro'))
                    ->filter()
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Alquileres</h1>
                <a href="{{ route('alquiler.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nuevo Alquiler
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row g-2 align-items-end mb-3">
                <div class="col-12 col-lg-4">
                    <label for="filtroTexto" class="form-label small text-muted mb-1">Buscar alquiler</label>
                    <input type="text" id="filtroTexto" class="form-control" placeholder="ID, matrícula, DNI o seguro">
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="filtroSeguro" class="form-label small text-muted mb-1">Tipo de seguro</label>
                    <select id="filtroSeguro" class="form-select">
                        <option value="">Todos los seguros</option>
                        @foreach($segurosDisponibles as $seguro)
                            <option value="{{ $seguro }}">{{ $seguro }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-6 col-lg-2">
                    <label for="filtroEstado" class="form-label small text-muted mb-1">Estado</label>
                    <select id="filtroEstado" class="form-select">
                        <option value="">Todos</option>
                        <option value="Devuelto">Devuelto</option>
                        <option value="Pendiente">Pendiente</option>
                    </select>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="d-flex gap-2">
                        <button type="button" id="btnFiltrar" class="btn btn-primary flex-fill">
                            <i class="bi bi-funnel me-1"></i>Filtrar
                        </button>
                        <button type="button" id="btnLimpiar" class="btn btn-outline-secondary flex-fill">
                            <i class="bi bi-arrow-counterclockwise me-1"></i>Limpiar
                        </button>
                    </div>
                </div>
            </div>

            <div class="panel p-3 p-md-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="tablaAlquileres">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Matrícula</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Fecha inicio</th>
                                <th scope="col">Dev. prevista</th>
                                <th scope="col">Dev. real</th>
                                <th scope="col">Días</th>
                                <th scope="col">Seguro</th>
                                <th scope="col">Precio total</th>
                                <th scope="col">Recargo</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alquileres as $alquiler)
                                @php
                                    $devuelto = $alquiler->fecha_devolucion_real !== null;
                                    $estadoTexto = $devuelto ? 'Devuelto' : 'Pendiente';
                                    $estadoClase = $devuelto ? 'status-devuelto' : 'status-pendiente';
                                @endphp
                                <tr
                                    data-id="{{ $alquiler->id }}"
                                    data-matricula="{{ $alquiler->matricula }}"
                                    data-dni="{{ $alquiler->dni }}"
                                    data-seguro="{{ $alquiler->tipo_seguro }}"
                                    data-estado="{{ $estadoTexto }}"
                                >
                                    <td class="fw-semibold">{{ $alquiler->id }}</td>
                                    <td class="fw-semibold">{{ $alquiler->matricula }}</td>
                                    <td>{{ $alquiler->dni }}</td>
                                    <td>{{ $alquiler->fecha_inicio?->format('d/m/Y') }}</td>
                                    <td>{{ $alquiler->fecha_devolucion_prevista?->format('d/m/Y') }}</td>
                                    <td>{{ $alquiler->fecha_devolucion_real?->format('d/m/Y') ?? '—' }}</td>
                                    <td>{{ $alquiler->duracion_dias }}</td>
                                    <td>{{ $alquiler->tipo_seguro }}</td>
                                    <td>${{ number_format((float) $alquiler->precio_total, 2) }}</td>
                                    <td>${{ number_format((float) $alquiler->recargo, 2) }}</td>
                                    <td>
                                        <span class="badge status-badge {{ $estadoClase }}">{{ $estadoTexto }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('alquiler.show', $alquiler->id) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('alquiler.destroy', $alquiler->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este alquiler?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger action-btn px-3">
                                                    <i class="bi bi-trash3 me-1"></i>Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-4">
                                        No hay alquileres registrados. <a href="{{ route('alquiler.create') }}">Crea el primero</a>.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="sinResultados" class="d-none">
                                <td colspan="12" class="text-center text-muted py-4">No hay alquileres que coincidan con los filtros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
@endsection
