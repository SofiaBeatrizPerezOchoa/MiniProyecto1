<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RolesAndAdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessControlTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndAdminUserSeeder::class);
    }

    public function test_guest_is_redirected_to_login_from_protected_routes(): void
    {
        $this->get('/')->assertRedirect('/login');
        $this->get('/usuario')->assertRedirect('/login');
        $this->get('/cliente')->assertRedirect('/login');
        $this->get('/coche')->assertRedirect('/login');
        $this->get('/alquiler')->assertRedirect('/login');
        $this->get('/oficina')->assertRedirect('/login');
    }

    public function test_public_registration_routes_are_not_available(): void
    {
        $this->get('/registro')->assertNotFound();
        $this->post('/registro')->assertNotFound();
        $this->get('/register')->assertNotFound();
        $this->post('/register')->assertNotFound();
    }

    public function test_authenticated_user_sees_the_renta_car_dashboard(): void
    {
        $admin = User::where('username', 'admin')->firstOrFail();

        $response = $this->actingAs($admin)->get('/');

        $response->assertOk();
        $response->assertSee('Bienvenido a RENTA CAR');
        $response->assertSee('Clientes');
        $response->assertSee('Oficinas');
        $response->assertSee('Usuarios');
    }

    public function test_employee_sees_only_allowed_modules_on_the_dashboard(): void
    {
        $employee = $this->crearEmpleado();

        $response = $this->actingAs($employee)->get('/');

        $response->assertOk();
        $response->assertSee('Bienvenido a RENTA CAR');
        $response->assertSee('Clientes');
        $response->assertSee('Coches');
        $response->assertSee('Alquileres');
        $response->assertDontSee('Oficinas');
        $response->assertDontSee('Usuarios');
    }

    public function test_administrator_can_access_every_module(): void
    {
        $admin = User::where('username', 'admin')->firstOrFail();

        $this->actingAs($admin)->get('/cliente')->assertOk();
        $this->actingAs($admin)->get('/coche')->assertOk();
        $this->actingAs($admin)->get('/alquiler')->assertOk();
        $this->actingAs($admin)->get('/oficina')->assertOk();
        $this->actingAs($admin)->get('/usuario')->assertOk();
    }

    public function test_employee_can_access_assigned_modules(): void
    {
        $employee = $this->crearEmpleado();

        $this->actingAs($employee)->get('/cliente')->assertOk();
        $this->actingAs($employee)->get('/coche')->assertOk();
        $this->actingAs($employee)->get('/alquiler')->assertOk();
    }

    public function test_employee_cannot_access_offices_or_user_management(): void
    {
        $employee = $this->crearEmpleado();

        $this->actingAs($employee)->get('/oficina')->assertForbidden();
        $this->actingAs($employee)->get('/usuario')->assertForbidden();
        $this->actingAs($employee)->get('/usuario/create')->assertForbidden();
        $this->actingAs($employee)->post('/usuario', [])->assertForbidden();
    }

    private function crearEmpleado(): User
    {
        $employee = User::factory()->create([
            'name' => 'Empleado de Prueba',
            'username' => 'empleado',
        ]);

        $employee->assignRole('empleado');

        return $employee;
    }
}
