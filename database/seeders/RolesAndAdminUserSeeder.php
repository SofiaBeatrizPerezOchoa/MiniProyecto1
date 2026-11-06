<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrador = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);

        Role::firstOrCreate([
            'name' => 'empleado',
            'guard_name' => 'web',
        ]);

        $admin = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrador',
                'email' => null,
                'password' => '12345678',
                'activo' => true,
            ],
        );

        if (! $admin->hasRole($administrador)) {
            $admin->assignRole($administrador);
        }
    }
}
