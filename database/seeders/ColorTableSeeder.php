<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ColorTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('colors')->truncate();

        $colors = [
            [
                'name' => 'Blanco',
                'hex'  => 'white',
            ],
            [
                'name' => 'Negro',
                'hex'  => 'black',
            ],
            [
                'name' => 'Plateado',
                'hex'  => 'silver',
            ],
            [
                'name' => 'Gris',
                'hex'  => 'grey',
            ],
            [
                'name' => 'Rojo',
                'hex'  => 'red',
            ],
            [
                'name' => 'Azul',

                'hex'  => 'blue',
            ],
            [
                'name' => 'Dorado',
                'hex'  => 'gold',
            ],
            [
                'name' => 'Naranja',
                'hex'  => 'orange',
            ],
            [
                'name' => 'Verde',
                'hex'  => 'green',
            ],
            [
                'name' => 'Marron',
                'hex'  => 'brown',
            ],
            [
                'name' => 'Otro',
                'hex'  => 'other',
            ],
        ];

        Color::query()->insert($colors);

        Schema::enableForeignKeyConstraints();

    }
}
