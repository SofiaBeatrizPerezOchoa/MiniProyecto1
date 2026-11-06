@extends('layouts.guest')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="panel p-4 p-md-5">
        <h1 class="page-title h4 mb-1">Iniciar sesión</h1>
        <p class="text-muted mb-4">Introduce tus credenciales para acceder al sistema.</p>

        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Usuario <span class="required-mark">*</span></label>
                <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" autocomplete="username" autofocus required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Contraseña <span class="required-mark">*</span></label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">
                <i class="bi bi-box-arrow-in-right me-1"></i>Entrar
            </button>
        </form>
    </div>
@endsection
