<?php

use App\Http\Controllers\AlquilerController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CocheController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/ejemplo', function () {
        return 'Mensaje de ejemplo';
    });
});

Route::middleware(['auth', 'role:administrador|empleado'])->group(function () {
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/coche', CocheController::class);
    Route::resource('/alquiler', AlquilerController::class);
});

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('/oficina', OficinaController::class);
    Route::resource('/usuario', UsuarioController::class)->except(['show', 'destroy']);
    Route::patch('/usuario/{usuario}/estado', [UsuarioController::class, 'cambiarEstado'])->name('usuario.estado');
});
