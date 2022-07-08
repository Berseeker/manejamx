<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
            Permission::factory()->create([
                'name'          => $permission,
                'guard_name'    => 'api'
            ]);
        }
    }
}
