<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RolesAndAdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndAdminUserSeeder::class);
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertSee('Iniciar sesión');
        $response->assertSee('Usuario');
        $response->assertSee('Contraseña');
    }

    public function test_login_screen_does_not_show_a_role_selector_or_registration_link(): void
    {
        $response = $this->get('/login');

        $response->assertOk();
        $response->assertDontSee('name="rol"', false);
        $response->assertDontSee('name="role"', false);
        $response->assertDontSee('Regístrate');
        $response->assertDontSee('Registro');
    }

    public function test_user_can_login_with_username_and_password(): void
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs(User::where('username', 'admin')->firstOrFail());
    }

    public function test_employee_can_login_with_demo_credentials(): void
    {
        $response = $this->post('/login', [
            'username' => 'empleado',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs(User::where('username', 'empleado')->firstOrFail());
    }

    public function test_username_is_normalized_before_authentication(): void
    {
        $response = $this->post('/login', [
            'username' => '  AD MIN  ',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_an_incorrect_password(): void
    {
        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => 'incorrecta',
        ]);

        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    public function test_inactive_user_cannot_login(): void
    {
        $admin = User::where('username', 'admin')->firstOrFail();
        $admin->update(['activo' => false]);

        $response = $this->post('/login', [
            'username' => 'admin',
            'password' => '12345678',
        ]);

        $response->assertSessionHasErrors(['username' => 'Usuario o contraseña incorrectos.']);
        $this->assertGuest();
    }
}
