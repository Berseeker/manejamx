<?php

namespace Tests\Feature\Site\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonalDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_personal_details()
    {
        $user = User::factory()->client()->create();

        $this->actingAs($user, 'api');

        $this->assertDatabaseHas('users', $user->only(['id', 'name', 'email', 'phone']));

        $parameters = [
            'name'  => 'Nuevo Nombre',
            'email' => 'nuevo@email.com',
            'phone' => '12345',
        ];

        $this->putJson('/api/site/users/' . $user->id . '/personal-details', $parameters)
            ->assertStatus(200);

        $this->assertDatabaseMissing('users', $user->only(['id', 'name', 'email', 'phone']));

        $this->assertDatabaseHas('users',
            array_merge(
                ['id' => $user->id],
                $parameters)
        );
    }

    public function test_update_personal_details_validation()
    {
        $user = User::factory()->client()->create();

        $this->actingAs($user, 'api');

        $this->assertDatabaseHas('users', $user->only(['id', 'name', 'email', 'phone']));

        $this->putJson('/api/site/users/' . $user->id . '/personal-details', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['El campo nombre es obligatorio.'],
                    'email' => ['El campo correo electrónico es obligatorio.'],
                    'phone' => ['El campo teléfono es obligatorio.'],
                ]
            ]);

        $this->assertDatabaseHas('users', $user->only(['id', 'name', 'email', 'phone']));
    }
}
