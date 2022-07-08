<?php

namespace Database\Seeders;

use App\Models\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Model::query()->truncate();

        Model::query()->create([
            'id'        => 324690,
            'brand_id'  => 690,
            'name'      => 'Alto 800'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
