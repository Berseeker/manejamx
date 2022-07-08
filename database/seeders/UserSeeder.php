<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::query()->truncate();

        /*User::factory()->admin()->create([
            'email' => 'admin@macasoft.com'
        ]);*/

        User::factory()->employee()->create([
            'email'     => 'employee@macasoft.com',
            'password'  => 123456
        ]);

        User::factory()->client()->create();

        Schema::enableForeignKeyConstraints();
    }
}
