<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Role::query()->truncate();

        $permissions = Permission::all();

        $adminRole = Role::factory()->create([
            'name'          => 'admin',
            'readable_name' => 'Administrador',
            'guard_name'    => 'api'
        ]);

        foreach ($permissions as $permission) {
            $adminRole->givePermissionTo($permission);
        }

        $employeeRole = Role::factory()->create([
            'name'          => 'employee',
            'readable_name' => 'Empleado',
            'guard_name'    => 'api'
        ]);

        foreach ($permissions as $permission) {
            $employeeRole->givePermissionTo($permission);
        }

        Role::factory()->create([
            'name'          => 'client',
            'readable_name' => 'Cliente',
            'guard_name'    => 'api'
        ]);

        Role::factory()->create([
            'name'          => 'affiliate',
            'readable_name' => 'Afiliado',
            'guard_name'    => 'api'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
