<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OficinaController extends Controller

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $datosOficinas = Oficina::all();

        return view('oficina.index')->with('oficinas', $datosOficinas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        return view('oficina.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $datosOficina = $request->validate($this->reglasValidacion());

        Oficina::create($datosOficina);

        return redirect()->route('oficina.index')->with('success', 'Oficina creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $oficina = Oficina::findOrFail($id);

        return view('oficina.show')->with('oficina', $oficina);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $oficina = Oficina::findOrFail($id);

        return view('oficina.edit')->with('oficina', $oficina);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $oficina = Oficina::findOrFail($id);

        $datosOficina = $request->validate($this->reglasValidacion($oficina->id));

        $oficina->update($datosOficina);

        return redirect()->route('oficina.index')->with('success', 'Oficina actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $oficina = Oficina::findOrFail($id);
        $oficina->delete();

        return redirect()->route('oficina.index')->with('success', 'Oficina eliminada correctamente.');
    }

    /**
     * Reglas de validacion del modulo de oficinas.
     *
     * @return array<string, mixed>
     */
    private function reglasValidacion(?int $id = null): array
    {
        return [
            'codigo_oficina' => [
                'required',
                'string',
                'max:10',
                Rule::unique('oficinas', 'codigo_oficina')->ignore($id),
            ],
            'ciudad' => 'required|string|max:50',
            'calle' => 'required|string|max:100',
            'numero' => 'required|integer|min:0',
            'codigo_postal' => 'required|string|max:10',
            'telefono' => 'required|string|max:20',
        ];
    }
}
