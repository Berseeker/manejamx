<?php

namespace Database\Seeders;

use App\Models\Transmission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transmissions')->truncate();

        Transmission::create([
            'name' => 'Automatica'
        ]);
        
        Transmission::create([
            'name' => 'Manual'
        ]);
    }
}
