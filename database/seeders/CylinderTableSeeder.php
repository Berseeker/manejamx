<?php

namespace Database\Seeders;

use App\Models\Cylinder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CylinderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cylinders')->truncate();

        $cylinders = [
            '4',
            '6',
            '8',
        ];

        foreach($cylinders as $cylinder){
            Cylinder::create([
                'name' => $cylinder
            ]);
        }
    }
}
