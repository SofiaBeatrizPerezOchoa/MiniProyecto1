<?php

namespace App\Http\Controllers;

use App\Models\Alquiler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $datosAlquileres = Alquiler::latest()->get();

        return view('alquiler.index')->with('alquileres', $datosAlquileres);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('alquiler.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $datosAlquiler = $request->validate($this->reglasValidacion());

        Alquiler::create($datosAlquiler);

        return redirect()->route('alquiler.index')->with('success', 'Alquiler creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $alquiler = Alquiler::findOrFail($id);

        return view('alquiler.show')->with('alquiler', $alquiler);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $alquiler = Alquiler::findOrFail($id);

        return view('alquiler.edit')->with('alquiler', $alquiler);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $alquiler = Alquiler::findOrFail($id);

        $datosAlquiler = $request->validate($this->reglasValidacion());

        $alquiler->update($datosAlquiler);

        return redirect()->route('alquiler.index')->with('success', 'Alquiler actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $alquiler = Alquiler::findOrFail($id);
        $alquiler->delete();

        return redirect()->route('alquiler.index')->with('success', 'Alquiler eliminado correctamente.');
    }

    /**
     * Reglas de validacion del modulo de alquileres.
     *
     * @return array<string, mixed>
     */
    private function reglasValidacion(): array
    {
        return [
            'matricula' => 'required|string|max:20',
            'dni' => 'required|digits:13',
            'fecha_inicio' => 'required|date',
            'fecha_devolucion_prevista' => 'required|date|after_or_equal:fecha_inicio',
            'fecha_devolucion_real' => 'nullable|date|after_or_equal:fecha_inicio',
            'duracion_dias' => 'required|integer|min:1',
            'tipo_seguro' => 'required|string|max:30',
            'precio_total' => 'required|numeric|min:0',
            'recargo' => 'required|numeric|min:0',
        ];
    }
}
