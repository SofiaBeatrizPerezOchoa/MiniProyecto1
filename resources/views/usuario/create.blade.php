@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="page-title h2 mb-1">Nuevo Usuario</h1>
            <p class="text-muted mb-0">Completa los datos para registrar un usuario.</p>
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
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="name" class="form-label">Nombre completo <span class="required-mark">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" maxlength="255" placeholder="Ingrese el nombre completo" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="username" class="form-label">Usuario <span class="required-mark">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" maxlength="50" placeholder="Se genera desde el nombre" autocomplete="off">
                    <div class="form-text">Se genera automáticamente desde el nombre. Puede editarlo; debe ser único.</div>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password" class="form-label">Contraseña <span class="required-mark">*</span></label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mínimo 8 caracteres" autocomplete="new-password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="password_confirmation" class="form-label">Confirmación de contraseña <span class="required-mark">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita la contraseña" autocomplete="new-password" required>
                </div>

                <div class="col-12 col-md-6">
                    <label for="rol" class="form-label">Tipo de usuario <span class="required-mark">*</span></label>
                    <select id="rol" name="rol" class="form-select @error('rol') is-invalid @enderror" required>
                        <option value="">Seleccione un tipo de usuario</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol }}" @selected(old('rol') === $rol)>{{ ucfirst($rol) }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="form-check mt-4">
                        <input type="hidden" name="activo" value="0">
                        <input class="form-check-input" type="checkbox" id="activo" name="activo" value="1" @checked(old('activo', true))>
                        <label class="form-check-label" for="activo">Usuario activo</label>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <button type="submit" class="btn btn-primary px-4">Guardar Usuario</button>
                <a href="{{ route('usuario.index') }}" class="btn btn-secondary px-4">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            const usernameInput = document.getElementById('username');

            if (!nameInput || !usernameInput) {
                return;
            }

            const usernames = @json($usernames);
            let usernameEdited = usernameInput.value.trim() !== '';

            const palabras = (texto) => texto
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
                .split(/\s+/)
                .filter(Boolean);

            const limpiar = (texto) => texto.replace(/[^a-z0-9._-]/g, '').slice(0, 50);

            const disponible = (base) => {
                let candidato = limpiar(base) || 'usuario';
                let sufijo = 2;

                while (usernames.includes(candidato)) {
                    const texto = String(sufijo++);
                    candidato = `${candidato.slice(0, 50 - texto.length)}${texto}`;
                }

                return candidato;
            };

            const generar = (nombre) => {
                const partes = palabras(nombre);

                if (partes.length === 0) {
                    return '';
                }

                const primerNombre = partes[0];

                if (partes.length === 1) {
                    return disponible(primerNombre);
                }

                const primerApellido = partes.length >= 3
                    ? partes[partes.length - 2]
                    : partes[partes.length - 1];

                const base = limpiar(primerNombre.charAt(0) + primerApellido);

                if (!usernames.includes(base)) {
                    return base;
                }

                return disponible(primerNombre + primerApellido.charAt(0));
            };

            usernameInput.addEventListener('input', () => {
                usernameEdited = true;
            });

            nameInput.addEventListener('input', () => {
                if (!usernameEdited) {
                    usernameInput.value = generar(nameInput.value);
                }
            });

            if (!usernameEdited && nameInput.value.trim() !== '') {
                usernameInput.value = generar(nameInput.value);
            }
        });
    </script>
@endpush
