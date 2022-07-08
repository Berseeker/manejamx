<?php

namespace Tests\Feature\Site;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $user = User::factory()->client()->create();

        $parameters = [
            'email'     => $user->email,
            'password'  => 'password',
        ];

        $this->postJson('/login', $parameters)
            ->assertStatus(204);
    }

    public function test_validate_login()
    {
        $this->postJson('/login', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email'     => ['El campo correo electrónico es obligatorio.'],
                    'password'  => ['El campo contraseña es obligatorio.']
                ]
            ]);
    }
}
