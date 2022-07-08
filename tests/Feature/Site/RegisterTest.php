<?php

namespace Tests\Feature\Site;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'client@maneja.com',
        ]);

        $parameters = [
            'name'                  => 'client',
            'email'                 => 'client@maneja.com',
            'phone'                 => '12345678',
            'zip_code'              => '1204',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];

        $this->postJson('/register', $parameters)
            ->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'email' => 'client@maneja.com',
            'client' => 1
        ]);
    }

    public function test_validate_register()
    {
        $this->postJson('/register', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'      => ['El campo nombre es obligatorio.'],
                    'email'     => ['El campo correo electrónico es obligatorio.'],
                    'password'  => ['El campo contraseña es obligatorio.'],
                    'phone'     => ['El campo teléfono es obligatorio.'],
                    'zip_code'  => ['El campo zip code es obligatorio.']
                ]
            ]);
    }

}
