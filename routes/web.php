<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/ejemplo', function () {
    return "Mensaje de ejemplo";
});

Route::resource('/cliente','App\Http\Controllers\ClienteController');
Route::resource('/oficina', 'App\Http\Controllers\OficinaController');
Route::resource('/coche', 'App\Http\Controllers\CocheController');
Route::resource('/alquiler', 'App\Http\Controllers\AlquilerController');

