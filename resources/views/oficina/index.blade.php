@extends('layouts.app')

@section('title', 'Lista de Oficinas')

@section('content')
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <h1 class="page-title h2 mb-0">Oficinas</h1>
                <a href="{{ route('oficina.create') }}" class="btn btn-primary px-4">
                    <i class="bi bi-plus-lg me-1"></i>Nueva Oficina
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="row g-2 align-items-end mb-3">
                <div class="col-12 col-lg-8">
                    <label for="filtroTexto" class="form-label small text-muted mb-1">Buscar oficina</label>
                    <input type="text" id="filtroTexto" class="form-control" placeholder="Código, ciudad o calle">
                </div>
                <div class="col-12 col-lg-4">
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
                    <table class="table table-hover align-middle mb-0" id="tablaOficinas">
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Calle</th>
                                <th scope="col">Número</th>
                                <th scope="col">Código postal</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($oficinas as $oficina)
                                <tr data-codigo="{{ $oficina->codigo_oficina }}" data-ciudad="{{ $oficina->ciudad }}" data-calle="{{ $oficina->calle }}">
                                    <td class="fw-semibold">{{ $oficina->codigo_oficina }}</td>
                                    <td>{{ $oficina->ciudad }}</td>
                                    <td>{{ $oficina->calle }}</td>
                                    <td>{{ $oficina->numero }}</td>
                                    <td>{{ $oficina->codigo_postal }}</td>
                                    <td>{{ $oficina->telefono }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('oficina.show', $oficina->id) }}" class="btn btn-sm btn-primary action-btn px-3">
                                                <i class="bi bi-eye me-1"></i>Ver
                                            </a>
                                            <a href="{{ route('oficina.edit', $oficina->id) }}" class="btn btn-sm btn-warning text-dark action-btn px-3">
                                                <i class="bi bi-pencil-square me-1"></i>Editar
                                            </a>
                                            <form action="{{ route('oficina.destroy', $oficina->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta oficina?')">
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
                                    <td colspan="7" class="text-center text-muted py-4">
                                        No hay oficinas registradas. <a href="{{ route('oficina.create') }}">Crea la primera</a>.
                                    </td>
                                </tr>
                            @endforelse
                            <tr id="sinResultados" class="d-none">
                                <td colspan="7" class="text-center text-muted py-4">No hay oficinas que coincidan con los filtros.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        
@endsection
