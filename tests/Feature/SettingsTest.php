<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_page_requires_authentication(): void
    {
        $response = $this->get('/settings');
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_settings(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/settings');

        $response->assertStatus(200);
        $response->assertSee('Ajustes');
    }

    public function test_authenticated_user_can_update_profile(): void
    {
        $user = User::factory()->create([
            'name' => 'Old Name',
            'email' => 'old@email.com',
        ]);

        $response = $this->actingAs($user)->post('/settings', [
            'name' => 'New Name',
            'email' => 'new@email.com',
            'phone' => '(11) 99999-8888',
            'gender' => 'masculino',
            'birth_date' => '1995-10-15',
            'pix_key_type' => 'cpf',
            'pix_key' => '123.456.789-09',
        ]);

        $response->assertRedirect('/settings');
        $response->assertSessionHas('status', 'settings-updated');

        $user->refresh();
        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('new@email.com', $user->email);
        $this->assertEquals('11999998888', $user->phone);
        $this->assertEquals('masculino', $user->gender);
        $this->assertEquals('1995-10-15', $user->birth_date->format('Y-m-d'));
        $this->assertEquals('cpf', $user->pix_key_type);
        $this->assertEquals('12345678909', $user->pix_key);
    }

    public function test_authenticated_user_can_update_password_with_correct_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put('/settings/password', [
            'current_password' => 'old-password-123',
            'new_password' => 'new-password-123',
            'new_password_confirmation' => 'new-password-123',
        ]);

        $response->assertRedirect('/settings');
        $response->assertSessionHas('status', 'password-updated');

        $user->refresh();
        $this->assertTrue(Hash::check('new-password-123', $user->password));
    }

    public function test_authenticated_user_cannot_update_password_with_incorrect_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('old-password-123'),
        ]);

        $response = $this->actingAs($user)->put('/settings/password', [
            'current_password' => 'wrong-password',
            'new_password' => 'new-password-123',
            'new_password_confirmation' => 'new-password-123',
        ]);

        $response->assertSessionHasErrors(['current_password']);
        
        $user->refresh();
        $this->assertTrue(Hash::check('old-password-123', $user->password));
    }
}
