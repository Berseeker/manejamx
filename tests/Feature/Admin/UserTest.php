<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_users()
    {
        $this->signIn();

        User::factory()->count(5)->admin()->create();
        User::factory()->count(5)->employee()->create();

        $this->getJson('/api/admin/users')
            ->assertStatus(200);
    }

    public function test_store_user()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $user = User::factory()->make();

        $parameters = [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'password'              => $user->password,
            'password_confirmation' => $user->password,
            'roles'                 => ['admin']
        ];

        $this->postJson('/api/admin/users', $parameters)
            ->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name'  => $user->name,
            'email' => $user->email
        ]);
    }

    public function test_store_user_validation()
    {
        $this->signIn();

        $parameters = [];

        $this->postJson('/api/admin/users', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'     => ['El campo nombre es obligatorio.'],
                    'email'    => ['El campo correo electrónico es obligatorio.'],
                    'password' => ['El campo contraseña es obligatorio.'],
                    'roles'    => ['El campo roles es obligatorio.']
                ]
            ]);
    }

    public function test_update_user()
    {
        $this->signIn();

        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'name'  => $user->name,
            'email' => $user->email
        ]);

        $parameters = [
            'name'  => 'Nuevo Nombre',
            'email' => $user->email,
            'roles' => ['admin']
        ];

        $this->putJson('/api/admin/users/' . $user->id, $parameters)
            ->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name'  => 'Nuevo Nombre',
            'email' => $user->email
        ]);

        $this->assertDatabaseMissing('users', [
            'name'  => $user->name
        ]);
    }

    public function test_update_user_validation()
    {
        $this->signIn();

        $user = User::factory()->create();

        $parameters = [];

        $this->putJson('/api/admin/users/' . $user->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'  => ['El campo nombre es obligatorio.'],
                    'email' => ['El campo correo electrónico es obligatorio.'],
                    'roles' => ['El campo roles es obligatorio.']
                ]
            ]);
    }

    public function test_destroy_user()
    {
        $this->signIn();

        $user = User::factory()->create();

        $this->delete('/api/admin/users/' . $user->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id
        ]);
    }
}
