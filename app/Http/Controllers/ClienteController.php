<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $datosClientes = Cliente::all();

        return view('cliente.index')->with('clientes', $datosClientes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $datosCliente = $request->validate($this->reglasValidacion());

        Cliente::create($datosCliente);

        return redirect()->route('cliente.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $cliente = Cliente::findOrFail($id);

        return view('cliente.details')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $cliente = Cliente::findOrFail($id);

        return view('cliente.edit')->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $cliente = Cliente::findOrFail($id);

        $datosCliente = $request->validate($this->reglasValidacion($cliente->DNI));

        $cliente->update($datosCliente);

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('cliente.index')->with('success', 'Cliente eliminado correctamente.');
    }

    /**
     * Reglas de validacion del modulo de clientes.
     *
     * @return array<string, mixed>
     */
    private function reglasValidacion(?string $dni = null): array
    {
        return [
            'DNI' => [
                'required',
                'string',
                'max:13',
                Rule::unique('clientes', 'DNI')->ignore($dni, 'DNI'),
            ],
            'nombre' => 'required|string|max:120',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|string|max:8',
            'tarjeta_credito' => 'nullable|string|max:16',
        ];
    }
}
