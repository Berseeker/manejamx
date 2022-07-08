<?php

namespace Database\Seeders;

use App\Models\VehicleStatus;
use Illuminate\Database\Seeder;

class VehicleStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleStatus::create([
            'id'   => VehicleStatus::AVAILABLE,
            'name' => 'Disponible'
        ]);

        VehicleStatus::create([
            'id'   => VehicleStatus::RESERVED,
            'name' => 'Reservado'
        ]);
        
        VehicleStatus::create([
            'id'   => VehicleStatus::SOLD,
            'name' => 'Vendido'
        ]);
    }
}
