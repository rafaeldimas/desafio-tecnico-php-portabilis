<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $seed = true;

    public function test_create_new_user()
    {
        $user = User::first();

        Sanctum::actingAs($user);

        $response = $this->post('api/users', [
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => 'teste',
            'role' => 'Admin',
        ]);

        $response
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'teste',
                'email' => 'teste@teste.com',
                'role_id' => 1,
                'active' => true,
            ]);
    }

    public function test_update_user()
    {
        $user = User::first();

        Sanctum::actingAs($user);

        /** @var User $userUpdate */
        $userUpdate = User::factory()->create();

        $response = $this->put("api/users/{$userUpdate->id}", [
            'active' => false,
        ]);

        $response
            ->assertOk()
            ->assertJsonFragment([
                'name' => $userUpdate->name,
                'email' => $userUpdate->email,
                'role_id' => $userUpdate->role_id,
                'active' => false,
            ]);
    }
}
