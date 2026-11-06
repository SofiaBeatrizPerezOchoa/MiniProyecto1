<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use App\Models\Cliente;
use App\Models\Coche;
use App\Models\Oficina;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the welcome dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();

        if (! $user instanceof User) {
            abort(403);
        }

        $contadores = [
            'clientes' => Cliente::count(),
            'coches' => Coche::count(),
            'alquileres' => Alquiler::count(),
        ];

        if ($user->hasRole('administrador')) {
            $contadores['oficinas'] = Oficina::count();
            $contadores['usuarios'] = User::count();
        }

        return view('dashboard', compact('contadores'));
    }
}
