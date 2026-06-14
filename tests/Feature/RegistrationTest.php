<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register_with_phone_and_matching_password(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '(11) 99999-1234',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'auth_mode' => 'register',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');

        $user = User::where('email', 'test@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('11999991234', $user->phone);
    }

    public function test_users_cannot_register_without_phone(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'auth_mode' => 'register',
        ]);

        $response->assertSessionHasErrors(['phone']);
        $this->assertGuest();
    }

    public function test_users_cannot_register_with_duplicate_phone(): void
    {
        User::factory()->create([
            'phone' => '11999991234',
        ]);

        $response = $this->post('/register', [
            'name' => 'Another User',
            'email' => 'another@example.com',
            'phone' => '(11) 99999-1234',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'auth_mode' => 'register',
        ]);

        $response->assertSessionHasErrors(['phone']);
        $this->assertGuest();
    }

    public function test_users_cannot_register_if_password_confirmation_does_not_match(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '(11) 99999-1234',
            'password' => 'password123',
            'password_confirmation' => 'different_password',
            'auth_mode' => 'register',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }
}
