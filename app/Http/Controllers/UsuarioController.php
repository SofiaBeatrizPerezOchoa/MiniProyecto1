<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        $usuarios = User::with('roles')->orderBy('name')->paginate(10);

        return view('usuario.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('usuario.create')->with('roles', $this->rolesDisponibles());
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->normalizarEntrada($request);

        $datos = $request->validate($this->reglasValidacion());

        DB::transaction(function () use ($datos): void {
            $usuario = User::create([
                'name' => $datos['name'],
                'username' => $datos['username'],
                'email' => null,
                'password' => $datos['password'],
                'activo' => (bool) $datos['activo'],
            ]);

            $usuario->assignRole($datos['rol']);
        });

        return redirect()->route('usuario.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $usuario): View
    {
        return view('usuario.edit', [
            'usuario' => $usuario,
            'roles' => $this->rolesDisponibles(),
        ]);
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $usuario): RedirectResponse
    {
        $this->normalizarEntrada($request);

        $datos = $request->validate($this->reglasValidacion($usuario));
        $activo = (bool) $datos['activo'];

        if ($usuario->id === auth()->id() && ! $activo) {
            throw ValidationException::withMessages([
                'activo' => 'No puedes deshabilitar tu propia cuenta.',
            ]);
        }

        $eraAdministradorActivo = $usuario->activo && $usuario->hasRole('administrador');
        $seraAdministradorActivo = $activo && $datos['rol'] === 'administrador';

        if ($eraAdministradorActivo && ! $seraAdministradorActivo && $this->esUltimoAdministradorActivo($usuario)) {
            throw ValidationException::withMessages([
                $activo ? 'rol' : 'activo' => 'No puedes deshabilitar ni quitar el rol al último administrador activo.',
            ]);
        }

        DB::transaction(function () use ($datos, $usuario, $activo): void {
            $usuario->fill([
                'name' => $datos['name'],
                'username' => $datos['username'],
                'activo' => $activo,
            ]);

            if (! empty($datos['password'])) {
                $usuario->password = $datos['password'];
            }

            $usuario->save();
            $usuario->syncRoles([$datos['rol']]);
        });

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Enable or disable the specified user.
     */
    public function cambiarEstado(Request $request, User $usuario): RedirectResponse
    {
        $datos = $request->validate([
            'activo' => ['required', 'boolean'],
        ]);

        $activo = (bool) $datos['activo'];

        if ($usuario->id === auth()->id() && ! $activo) {
            return back()->with('error', 'No puedes deshabilitar tu propia cuenta.');
        }

        if (! $activo && $this->esUltimoAdministradorActivo($usuario)) {
            return back()->with('error', 'No puedes deshabilitar al último administrador activo.');
        }

        $usuario->update(['activo' => $activo]);

        return back()->with(
            'success',
            $activo ? 'Usuario habilitado correctamente.' : 'Usuario deshabilitado correctamente.',
        );
    }

    /**
     * Get the roles available for assignment.
     *
     * @return Collection<int, string>
     */
    private function rolesDisponibles(): Collection
    {
        return Role::query()->orderBy('name')->pluck('name');
    }

    /**
     * Normalize the username and boolean fields before validation.
     */
    private function normalizarEntrada(Request $request): void
    {
        $request->merge([
            'username' => Str::lower((string) preg_replace('/\s+/', '', (string) $request->input('username'))),
            'activo' => $request->boolean('activo'),
        ]);
    }

    /**
     * Validation rules for creating and updating users.
     *
     * @return array<string, mixed>
     */
    private function reglasValidacion(?User $usuario = null): array
    {
        $username = [
            'required',
            'string',
            'max:50',
            'regex:/^[a-z0-9._-]+$/',
        ];

        $username[] = $usuario
            ? Rule::unique('users', 'username')->ignore($usuario->id)
            : Rule::unique('users', 'username');

        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => $username,
            'password' => [
                $usuario ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'rol' => [
                'required',
                'string',
                Rule::exists('roles', 'name')->where('guard_name', 'web'),
            ],
            'activo' => ['required', 'boolean'],
        ];
    }

    /**
     * Determine whether the user is the last active administrator.
     */
    private function esUltimoAdministradorActivo(User $usuario): bool
    {
        if (! $usuario->activo || ! $usuario->hasRole('administrador')) {
            return false;
        }

        return ! User::role('administrador')
            ->where('activo', true)
            ->whereKeyNot($usuario->getKey())
            ->exists();
    }
}
