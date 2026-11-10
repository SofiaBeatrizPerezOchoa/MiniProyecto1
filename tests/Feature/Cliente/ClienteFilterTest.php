<?php

namespace Tests\Feature\Cliente;

use App\Models\Cliente;
use Database\Seeders\RolesAndAdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClienteFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RolesAndAdminUserSeeder::class);
    }

    public function test_clientes_can_be_filtered_by_search(): void
    {
        Cliente::create([
            'DNI' => '11111111A',
            'nombre' => 'Juan Pérez',
            'direccion' => 'Calle Mayor 1',
            'telefono' => '12345678',
        ]);

        Cliente::create([
            'DNI' => '22222222B',
            'nombre' => 'María García',
            'direccion' => 'Avenida Paz 2',
            'telefono' => '87654321',
        ]);

        $admin = \App\Models\User::where('username', 'admin')->firstOrFail();

        $response = $this->actingAs($admin)->get(route('cliente.index', [
            'buscar' => 'Juan',
        ]));

        $response->assertOk();

        $clientes = $response->viewData('clientes');

        $this->assertCount(1, $clientes);
        $this->assertSame('Juan Pérez', $clientes->first()->nombre);
        $this->assertSame('11111111A', $clientes->first()->DNI);
    }

    public function test_cliente_filter_preserves_value_in_input(): void
    {
        $admin = \App\Models\User::where('username', 'admin')->firstOrFail();

        $response = $this->actingAs($admin)->get(route('cliente.index', [
            'buscar' => 'Juan',
        ]));

        $response->assertOk();
        $response->assertSee('value="Juan"');
    }
}
