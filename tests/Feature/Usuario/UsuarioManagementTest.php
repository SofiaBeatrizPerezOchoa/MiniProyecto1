<?php

namespace Tests\Feature\Usuario;

use App\Models\User;
use Database\Seeders\RolesAndAdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Middleware\RoleMiddleware;
use Tests\TestCase;

class UsuarioManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndAdminUserSeeder::class);

        $this->admin = User::where('username', 'admin')->firstOrFail();
    }

    public function test_user_can_be_created_with_a_role(): void
    {
        $response = $this->actingAs($this->admin)->post(route('usuario.store'), [
            'name' => 'Juan Pérez',
            'username' => 'JUAN.PEREZ',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'rol' => 'empleado',
            'activo' => '1',
        ]);

        $response->assertRedirect(route('usuario.index'));

        $usuario = User::where('username', 'juan.perez')->firstOrFail();

        $this->assertSame('Juan Pérez', $usuario->name);
        $this->assertTrue($usuario->activo);
        $this->assertTrue($usuario->hasRole('empleado'));
        $this->assertTrue(Hash::check('secret123', $usuario->password));
    }

    public function test_user_can_be_updated_without_changing_the_password(): void
    {
        $usuario = $this->crearUsuario('carlos', 'password-anterior');

        $response = $this->actingAs($this->admin)->put(route('usuario.update', $usuario), [
            'name' => 'Carlos Actualizado',
            'username' => 'carlos',
            'password' => '',
            'password_confirmation' => '',
            'rol' => 'empleado',
            'activo' => '1',
        ]);

        $response->assertRedirect(route('usuario.index'));

        $usuario->refresh();

        $this->assertSame('Carlos Actualizado', $usuario->name);
        $this->assertTrue(Hash::check('password-anterior', $usuario->password));
    }

    public function test_user_password_can_be_changed_from_the_module(): void
    {
        $usuario = $this->crearUsuario('laura', 'password-anterior');

        $response = $this->actingAs($this->admin)->put(route('usuario.update', $usuario), [
            'name' => $usuario->name,
            'username' => $usuario->username,
            'password' => 'password-nueva',
            'password_confirmation' => 'password-nueva',
            'rol' => 'empleado',
            'activo' => '1',
        ]);

        $response->assertRedirect(route('usuario.index'));

        $this->assertTrue(Hash::check('password-nueva', $usuario->fresh()->password));
    }

    public function test_user_can_be_disabled_and_enabled(): void
    {
        $usuario = $this->crearUsuario('maria', 'password');

        $this->actingAs($this->admin)
            ->patch(route('usuario.estado', $usuario), ['activo' => '0'])
            ->assertRedirect();

        $this->assertFalse($usuario->fresh()->activo);

        $this->actingAs($this->admin)
            ->patch(route('usuario.estado', $usuario), ['activo' => '1'])
            ->assertRedirect();

        $this->assertTrue($usuario->fresh()->activo);
    }

    public function test_user_cannot_disable_their_own_account(): void
    {
        $response = $this->actingAs($this->admin)
            ->patch(route('usuario.estado', $this->admin), ['activo' => '0']);

        $response->assertSessionHas('error', 'No puedes deshabilitar tu propia cuenta.');

        $this->assertTrue($this->admin->fresh()->activo);
    }

    public function test_user_cannot_disable_the_last_active_administrator(): void
    {
        $employee = $this->crearUsuario('operador', 'password');

        $this->withoutMiddleware(RoleMiddleware::class);

        $response = $this->actingAs($employee)
            ->patch(route('usuario.estado', $this->admin), ['activo' => '0']);

        $response->assertSessionHas('error', 'No puedes deshabilitar al último administrador activo.');

        $this->assertTrue($this->admin->fresh()->activo);
    }

    public function test_last_active_administrator_cannot_lose_the_administrator_role(): void
    {
        $response = $this->actingAs($this->admin)->put(route('usuario.update', $this->admin), [
            'name' => $this->admin->name,
            'username' => $this->admin->username,
            'password' => '',
            'password_confirmation' => '',
            'rol' => 'empleado',
            'activo' => '1',
        ]);

        $response->assertSessionHasErrors('rol');

        $this->assertTrue($this->admin->fresh()->hasRole('administrador'));
    }

    public function test_username_must_be_unique_but_can_remain_the_same_on_edit(): void
    {
        $this->crearUsuario('pedro', 'password');

        $this->actingAs($this->admin)->put(route('usuario.update', $this->admin), [
            'name' => $this->admin->name,
            'username' => 'admin',
            'password' => '',
            'password_confirmation' => '',
            'rol' => 'administrador',
            'activo' => '1',
        ])->assertSessionHasNoErrors();

        $this->actingAs($this->admin)->post(route('usuario.store'), [
            'name' => 'Otro Pedro',
            'username' => 'pedro',
            'password' => 'password',
            'password_confirmation' => 'password',
            'rol' => 'empleado',
            'activo' => '1',
        ])->assertSessionHasErrors('username');
    }

    private function crearUsuario(string $username, string $password): User
    {
        $usuario = User::factory()->create([
            'username' => $username,
            'password' => $password,
        ]);

        $usuario->assignRole('empleado');

        return $usuario;
    }
}
