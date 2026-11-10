<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndAdminUserSeeder extends Seeder
{
    /**
     * Create the application roles and demo users.
     */
    public function run(): void
    {
        $administrador = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);

        $empleadoRol = Role::firstOrCreate([
            'name' => 'empleado',
            'guard_name' => 'web',
        ]);

        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Prueba Administrador',
                'email' => null,
                'password' => '12345678',
                'activo' => true,
            ],
        );

        $empleado = User::firstOrCreate(
            ['username' => 'empleado'],
            [
                'name' => 'Prueba Empleado',
                'email' => null,
                'password' => '12345678',
                'activo' => true,
            ],
        );

        if ($admin->name !== 'Prueba Administrador') {
            $admin->update(['name' => 'Prueba Administrador']);
        }

        if ($empleado->name !== 'Prueba Empleado') {
            $empleado->update(['name' => 'Prueba Empleado']);
        }

        if (! $admin->hasRole($administrador)) {
            $admin->assignRole($administrador);
        }

        if (! $empleado->hasRole($empleadoRol)) {
            $empleado->assignRole($empleadoRol);
        }
    }
}
