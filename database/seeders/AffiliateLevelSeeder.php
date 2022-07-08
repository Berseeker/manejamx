<?php

namespace Database\Seeders;

use App\Models\AffiliateLevel;
use Illuminate\Database\Seeder;

class AffiliateLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AffiliateLevel::query()->create([
            'name'          => 'Oro',
            'start_points'  => 500,
            'end_points'    => 10000
        ]);

        AffiliateLevel::query()->create([
            'name'          => 'Plata',
            'start_points'  => 250,
            'end_points'    => 499
        ]);

        AffiliateLevel::query()->create([
            'name'          => 'Bronce',
            'start_points'  => 0,
            'end_points'    => 249
        ]);
    }
}
