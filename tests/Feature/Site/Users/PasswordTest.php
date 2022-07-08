<?php

namespace Tests\Feature\Site\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_password()
    {
        $current_password = Str::random(10);

        $new_password = Str::random(10);

        $user = User::factory()->client()->create([
            'password' => $current_password
        ]);

        $this->actingAs($user, 'api');

        $parameters = [
            'current_password'      => $current_password,
            'password'              => $new_password,
            'password_confirmation' => $new_password,
        ];

        $this->putJson('/api/site/users/' . $user->id . '/password', $parameters)
            ->assertStatus(200);
    }

    public function test_update_password_validation()
    {
        $user = User::factory()->client()->create();

        $this->actingAs($user, 'api');

        $this->putJson('/api/site/users/' . $user->id . '/password', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'current_password'  => [
                        'El campo contraseña actual es obligatorio.',
                        'La contraseña actual es incorrecta.'
                    ],
                    'password' => ['El campo contraseña es obligatorio.']
                ]
            ]);
    }
}
