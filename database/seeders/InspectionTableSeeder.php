<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inspections')->truncate();

        $inspections = [
            'Motor',
            'Frenos',
            'Embrague',
            'Caja',
            'Tren trasero',
            'Amortiguadores',
            'Llantas',
            'Cubiertas',
            'Estructura general'
        ];

        foreach($inspections as $inspection){
            Inspection::create([
                'name' => $inspection
            ]);
        }
    }
}
