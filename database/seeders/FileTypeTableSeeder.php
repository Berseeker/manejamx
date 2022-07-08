<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Seeder;

class FileTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FileType::query()->create([
            'id'   => FileType::THREE_SIXTY,
            'name' => '360'
        ]);

        FileType::query()->create([
            'id'   => FileType::EXTERIOR,
            'name' => 'Exterior'
        ]);

        FileType::query()->create([
            'id'   => FileType::INTERIOR,
            'name' => 'Interior'
        ]);

        FileType::query()->create([
            'id'   => FileType::PRINCIPAL,
            'name' => 'Principal'
        ]);

        FileType::query()->create([
            'id'   => FileType::ID,
            'name' => 'Identificación oficial con fotografía'
        ]);

        FileType::query()->create([
            'id'   => FileType::RFC,
            'name' => 'Registro Federal de contribuyentes (RFC)'
        ]);

        FileType::query()->create([
            'id'   => FileType::CONSTITUTIVE_ACT,
            'name' => 'Acta Constitutiva (Personas morales)'
        ]);

        FileType::query()->create([
            'id'   => FileType::BANK_COVER,
            'name' => 'Caratula bancaria (Clabe Interbancaria)'
        ]);

        FileType::query()->create([
            'id'   => FileType::ADDRESS_VOUCHER,
            'name' => 'Comprobante de domicilio (Dirección fiscal)'
        ]);
    }
}
