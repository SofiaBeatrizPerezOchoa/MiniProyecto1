<?php

namespace Tests\Feature\Usuario;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DemoUsersSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_the_demo_users_with_their_roles(): void
    {
        $this->seed(DatabaseSeeder::class);

        $admin = User::where('username', 'admin')->firstOrFail();
        $empleado = User::where('username', 'empleado')->firstOrFail();

        $this->assertSame('Prueba Administrador', $admin->name);
        $this->assertSame('Prueba Empleado', $empleado->name);
        $this->assertSame('admin', $admin->username);
        $this->assertSame('empleado', $empleado->username);
        $this->assertTrue($admin->activo);
        $this->assertTrue($empleado->activo);
        $this->assertTrue(Hash::check('12345678', $admin->password));
        $this->assertTrue(Hash::check('12345678', $empleado->password));
        $this->assertTrue($admin->hasRole('administrador'));
        $this->assertTrue($empleado->hasRole('empleado'));
        $this->assertFalse($empleado->hasRole('administrador'));
        $this->assertSame(2, User::count());
        $this->assertSame(2, Role::count());
    }

    public function test_running_the_seeder_twice_does_not_duplicate_users_or_roles(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(2, User::count());
        $this->assertSame(2, Role::count());
    }
}
