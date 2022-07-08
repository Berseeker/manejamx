<?php

namespace Tests\Feature\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_roles()
    {
        $this->signIn();

        $this->getJson('/api/admin/roles')
            ->assertStatus(200);
    }

    public function test_store_role()
    {
        $this->signIn();

        $role = Role::factory()->make();

        $parameters = [
            'name'          => $role->name,
            'readable_name' => $role->readable_name,
            'permissions'   => Permission::all()->pluck('name')
        ];

        $this->postJson('/api/admin/roles', $parameters)
            ->assertStatus(201);

        $this->assertDatabaseHas('roles', [
            'name'  => $role->name
        ]);
    }

    public function test_store_role_validation()
    {
        $this->signIn();

        $parameters = [];

        $this->postJson('/api/admin/roles', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'          => ['El campo nombre es obligatorio.'],
                    'readable_name' => ['El campo readable name es obligatorio.'],
                    'permissions'   => ['El campo permissions es obligatorio.'],
                ]
            ]);
    }

    public function test_update_role()
    {
        $this->signIn();

        $role = Role::factory()->create();

        $this->assertDatabaseHas('roles', [
            'name'  => $role->name
        ]);

        $parameters = [
            'name'          => 'Nuevo Nombre',
            'readable_name' => 'Nuevo Nombre',
            'permissions'   => Permission::all()->pluck('name')
        ];

        $this->putJson('/api/admin/roles/' . $role->id, $parameters)
            ->assertStatus(200);

        $this->assertDatabaseHas('roles', [
            'name'  => 'Nuevo Nombre'
        ]);

        $this->assertDatabaseMissing('roles', [
            'name'  => $role->name
        ]);
    }

    public function test_update_role_validation()
    {
        $this->signIn();

        $role = Role::factory()->create();

        $parameters = [];

        $this->putJson('/api/admin/roles/' . $role->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'          => ['El campo nombre es obligatorio.'],
                    'readable_name' => ['El campo readable name es obligatorio.'],
                    'permissions'   => ['El campo permissions es obligatorio.'],
                ]
            ]);
    }

    public function test_destroy_role()
    {
        $this->signIn();

        $role = Role::factory()->create();

        $this->assertDatabaseHas('roles', [
            'id' => $role->id
        ]);

        $this->delete('/api/admin/roles/' . $role->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id
        ]);
    }
}
