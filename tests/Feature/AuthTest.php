<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    // Test de la page de connexion
    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    // Test de connexion valide
    public function test_users_can_authenticate()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard'));
    }

    // Test de mot de passe invalide
    public function test_users_cannot_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ]);

        $this->assertGuest();
    }

    // Test de déconnexion
    public function test_users_can_logout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
