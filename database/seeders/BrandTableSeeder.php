<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Brand::query()->truncate();

        Brand::query()->create([
            'id'    => 690,
            'name'  => 'Suzuki'
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
