@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    @php($rolActual = $usuario->getRoleNames()->first())
    @php($esUsuarioActual = $usuario->id === auth()->id())

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="page-title h2 mb-1">Editar Usuario</h1>
            <p class="text-muted mb-0">{{ $usuario->name }} · {{ $usuario->username }}</p>
        </div>
        <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary px-4">Volver al listado</a>
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
        <form action="{{ route('usuario.update', $usuario) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nombre completo <span class="required-mark">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $usuario->name) }}" class="form-control @error('name') is-invalid @enderror" maxlength="255" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="username" class="form-label">Usuario <span class="required-mark">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username', $usuario->username) }}" class="form-control @error('username') is-invalid @enderror" maxlength="50" autocomplete="off" required>
                    <div class="form-text">Solo minúsculas, números, puntos, guiones y guiones bajos.</div>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Dejar en blanco para conservar la actual" autocomplete="new-password">
                    <div class="form-text">Si se deja vacía, se conservará la contraseña actual.</div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmación de contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita la nueva contraseña" autocomplete="new-password">
                </div>

                <div class="col-12 col-md-6">
                    <label for="rol" class="form-label">Rol <span class="required-mark">*</span></label>
                    <select id="rol" name="rol" class="form-select @error('rol') is-invalid @enderror" required>
                        @foreach($roles as $rol)
                            <option value="{{ $rol }}" @selected(old('rol', $rolActual) === $rol)>{{ ucfirst($rol) }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="form-check mt-4">
                        @if($esUsuarioActual)
                            <input type="hidden" name="activo" value="1">
                            <input class="form-check-input" type="checkbox" id="activo" checked disabled>
                            <label class="form-check-label" for="activo">Usuario activo</label>
                            <div class="form-text">No puedes deshabilitar tu propia cuenta.</div>
                        @else
                            <input type="hidden" name="activo" value="0">
                            <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" @checked(old('activo', $usuario->activo))>
                            <label class="form-check-label" for="activo">Usuario activo</label>
                        @endif
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-primary px-4">Guardar cambios</button>
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
