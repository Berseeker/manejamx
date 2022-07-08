<?php

namespace Tests;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Role::factory()->admin()->create();
        Role::factory()->employee()->create();
        Role::factory()->client()->create();

        $this->addPermission();
    }

    public function addPermission()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name'          => $permission,
                'guard_name'    => 'api'
            ]);
        }
    }

    public function signIn($data = [])
    {
        $user = User::factory()->create($data);

        $this->actingAs($user, 'api');

        return $user;
    }
}
