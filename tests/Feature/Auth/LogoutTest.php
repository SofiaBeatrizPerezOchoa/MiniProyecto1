<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Database\Seeders\RolesAndAdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_logout(): void
    {
        $this->seed(RolesAndAdminUserSeeder::class);

        $admin = User::where('username', 'admin')->firstOrFail();

        $response = $this->actingAs($admin)->post('/logout');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
