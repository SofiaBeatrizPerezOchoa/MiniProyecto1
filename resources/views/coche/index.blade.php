@extends('layouts.app')

@section('title', 'Lista de Coches')

@section('content')
            @php
                $gruposDisponibles = collect(['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D', 'Grupo E', 'Grupo F'])
                    ->merge($coches->pluck('grupo'))
                    ->filter()
                    ->unique()
                    ->sort()
                    ->values();
            @endphp

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Coches</h1>
                <a href="{{ route('coche.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nuevo Coche
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row g-2 align-items-end mb-3">
                <div class="col-12 col-lg-6">
                    <label for="filtroTexto" class="form-label small text-muted mb-1">Buscar coche</label>
                    <input type="text" id="filtroTexto" class="form-control" placeholder="Matrícula, marca o modelo">
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label for="filtroGrupo" class="form-label small text-muted mb-1">Grupo</label>
                    <select id="filtroGrupo" class="form-select">
                        <option value="">Todos los grupos</option>
                        @foreach($gruposDisponibles as $grupo)
                            <option value="{{ $grupo }}">{{ $grupo }}</option>
                        @endforeach
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
                    <table class="table table-hover align-middle mb-0" id="tablaCoches">
                        <thead>
                            <tr>
                                <th scope="col">Matrícula</th>
                                <th scope="col">Grupo</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Puertas</th>
                                <th scope="col">Plazas</th>
                                <th scope="col">Maletero</th>
                                <th scope="col">Edad mínima</th>
                                <th scope="col">Oficina</th>
                                <th scope="col">Estado</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coches as $coche)
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
                                @endphp
                                <tr data-matricula="{{ $coche->matricula }}" data-marca="{{ $coche->marca }}" data-modelo="{{ $coche->modelo }}" data-grupo="{{ $coche->grupo }}">
                                    <td class="fw-semibold">{{ $coche->matricula }}</td>
                                    <td>{{ $coche->grupo }}</td>
                                    <td>{{ $coche->marca }}</td>
                                    <td>{{ $coche->modelo }}</td>
                                    <td>{{ $coche->numero_puertas }}</td>
                                    <td>{{ $coche->numero_plazas }}</td>
                                    <td>{{ $coche->capacidad_maletero }} L</td>
                                    <td>{{ $coche->edad_minima }}</td>
                                    <td>{{ $coche->codigo_oficina }}</td>
                                    <td>
                                        <span class="badge status-badge {{ $estadoClase }}">{{ $coche->estado }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('coche.show', $coche->id) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('coche.edit', $coche->id) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('coche.destroy', $coche->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este coche?')">
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
                                    <td colspan="11" class="text-center text-muted py-4">
                                        No hay coches registrados. <a href="{{ route('coche.create') }}">Crea el primero</a>.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="sinResultados" class="d-none">
                                <td colspan="11" class="text-center text-muted py-4">No hay coches que coincidan con los filtros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
@endsection
