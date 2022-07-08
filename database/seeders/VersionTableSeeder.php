<?php

namespace Database\Seeders;

use App\Models\Version;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class VersionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Version::query()->truncate();

        Version::query()->create([
            'id'        => '2019690324240',
            'model_id'  => 324690,
            'name'      => '5p GLS L4/1.4 Man',
            'year'      => 2019,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
