<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_create_group(): void
    {
        $response = $this->postJson('/groups', [
            'name' => 'Trip to Paris',
            'description' => 'Shared expenses',
            'type' => 'viagem',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_group(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/groups', [
            'name' => 'República Centro',
            'description' => 'Contas do apartamento',
            'type' => 'casa',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'group' => [
                'id',
                'name',
                'description',
                'type',
                'created_by',
            ],
            'link',
        ]);

        $group = Group::where('name', 'República Centro')->first();
        $this->assertNotNull($group);
        $this->assertEquals('Contas do apartamento', $group->description);
        $this->assertEquals('casa', $group->type);
        $this->assertEquals($user->id, $group->created_by);

        $this->assertTrue($group->members->contains($user));
    }

    public function test_group_creation_validation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/groups', [
            'name' => '',
            'description' => '',
            'type' => '',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'description', 'type']);

        $response = $this->actingAs($user)->postJson('/groups', [
            'name' => 'Some Group',
            'description' => 'Some description',
            'type' => 'invalid_type',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['type']);
    }
}
