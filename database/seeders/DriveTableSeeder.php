<?php

namespace Database\Seeders;

use App\Models\Drive;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drives')->truncate();

        Drive::create([
            'name' => 'Delantera'
        ]);
        Drive::create([
            'name' => '4x4'
        ]);
        Drive::create([
            'name' => 'Trasera'
        ]);
        
    }
}
