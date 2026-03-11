<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_returns_token_for_valid_credentials()
    {
        $admin = Admin::factory()->create([
            'username' => 'admin1',
            'password' => 'secret',
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'admin1',
            'password' => 'secret',
        ]);

        $response->assertOk()
                 ->assertJson([
                     'status' => true,
                     'message' => 'Login successful',
                 ])
                 ->assertJsonStructure(['token']);
    }

    /** @test */
    public function login_fails_with_wrong_username()
    {
        Admin::factory()->create([
            'username' => 'admin1',
            'password' => 'secret',
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'doesnotexist',
            'password' => 'secret',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => false,
                     'message' => 'Invalid credentials',
                 ]);
    }

    /** @test */
    public function login_fails_with_wrong_password()
    {
        Admin::factory()->create([
            'username' => 'admin1',
            'password' => 'secret',
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'admin1',
            'password' => 'wrong',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'status' => false,
                     'message' => 'Invalid credentials',
                 ]);
    }

    /** @test */
    public function logout_returns_success_message()
    {
        $response = $this->postJson('/api/logout');

        $response->assertOk()
                 ->assertJson([
                     'status' => true,
                     'message' => 'Logged out successfully',
                 ]);
    }
}
