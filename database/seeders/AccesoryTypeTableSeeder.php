<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\AccessoryType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesoryTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $type = AccessoryType::create([
            'name' => 'Comodidad'
        ]);
        
        $type = AccessoryType::create([
            'name' => 'Tecnico'
        ]);
        
        $type = AccessoryType::create([
            'name' => 'Seguridad'
        ]);
        
        $type = AccessoryType::create([
            'name' => 'Entretenimiento'
        ]);
        
        $type = AccessoryType::create([
            'name' => 'Utilidades'
        ]);

        $accessories = [
            [
                'name' => 'Asientos refrigerados',
                'type_id' => 1
            ],
            [
                'name' => 'Asientos con calefacción ',
                'type_id' => 1
            ],
            [
                'name' => 'Interior de Cuero',
                'type_id' => 1
            ],
            [
                'name' => 'Sun Roof',
                'type_id' => 1
            ],
            [
                'name' => 'Pantalla de visualización frontal',
                'type_id' => 2
            ],
            [
                'name' => 'Encendido sin llave',
                'type_id' => 2
            ],
            [
                'name' => 'Asiento del conductor eléctrico',
                'type_id' => 2
            ],
            [
                'name' => 'Asiento del pasajero eléctrico',
                'type_id' => 2
            ],
            [
                'name' => 'Sensores de punto ciego',
                'type_id' => 3
            ],
            [
                'name' => 'Advertencia de salida de carril',
                'type_id' => 3
            ],
            [
                'name' => 'Asistente de parqueo',
                'type_id' => 3
            ],
            [
                'name'    => 'Cámara trasera',
                'type_id' => 3
            ],
            [
                'name'    => 'Video DVD',
                'type_id' => 4
            ],
            [
                'name'    => 'Sonido Primium',
                'type_id' => 4
            ],
            [
                'name'    => 'Radio',
                'type_id' => 4
            ],
            [
                'name'    => 'Navegación GPS',
                'type_id' => 5
            ],
            [
                'name'    => 'Asiento de la tercera fila',
                'type_id' => 5
            ],
            [
                'name'    => 'Enganche de remolque',
                'type_id' => 5
            ],
        ];


        foreach($accessories as $accessory){
            Accessory::create($accessory);
        }

    }
}
