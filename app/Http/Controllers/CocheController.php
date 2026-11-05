<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CocheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $datosCoches = Coche::all();

        return view('coche.index')->with('coches', $datosCoches);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('coche.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $datosCoche = $request->validate($this->reglasValidacion());

        Coche::create($datosCoche);

        return redirect()->route('coche.index')->with('success', 'Coche creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $coche = Coche::findOrFail($id);

        return view('coche.show')->with('coche', $coche);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $coche = Coche::findOrFail($id);

        return view('coche.edit')->with('coche', $coche);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $coche = Coche::findOrFail($id);

        $datosCoche = $request->validate($this->reglasValidacion($coche->id));

        $coche->update($datosCoche);

        return redirect()->route('coche.index')->with('success', 'Coche actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $coche = Coche::findOrFail($id);
        $coche->delete();

        return redirect()->route('coche.index')->with('success', 'Coche eliminado correctamente.');
    }

    /**
     * Reglas de validacion del modulo de coches.
     *
     * @return array<string, mixed>
     */
    private function reglasValidacion(?int $id = null): array
    {
        return [
            'matricula' => [
                'required',
                'string',
                'max:20',
                Rule::unique('coches', 'matricula')->ignore($id),
            ],
            'grupo' => 'required|string|max:20',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'numero_puertas' => 'required|integer|min:1',
            'numero_plazas' => 'required|integer|min:1',
            'capacidad_maletero' => 'required|integer|min:0',
            'edad_minima' => 'required|integer|min:0',
            'codigo_oficina' => 'required|string|max:10',
            'estado' => 'required|string|max:20',
        ];
    }
}
