<?php

namespace Tests\Feature\Site\Affiliates;

use App\Models\Affiliate;
use App\Models\FileType;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AffiliateTest extends TestCase
{
    use RefreshDatabase;

    function test_store_affiliate()
    {
        Storage::fake();

        $status = Status::factory()->create(['id' => Status::IN_PROCESS]);
        $data = Affiliate::factory()->make();

        $identification = FileType::factory()->create(['id' => FileType::ID]);
        $rfc = FileType::factory()->create(['id' => FileType::RFC]);
        $address = FileType::factory()->create(['id' => FileType::ADDRESS_VOUCHER]);
        $constitutive = FileType::factory()->create(['id' => FileType::CONSTITUTIVE_ACT]);
        $bank = FileType::factory()->create(['id' => FileType::BANK_COVER]);

        $parameters = [
            'commercial_name'   => $data->commercial_name,
            'business_name'     => $data->business_name,
            'rfc'               => $data->rfc,
            'address'           => $data->address,
            'name'              => $data->name,
            'last_name'         => $data->last_name,
            'email'             => $data->email,
            'phone'             => $data->phone,
            'password'          => 123456,
            'identification'    => UploadedFile::fake()->create('identification.pdf'),
            'rcf_photo'         => UploadedFile::fake()->create('rcf_photo.pdf'),
            'address_voucher'   => UploadedFile::fake()->create('address_voucher.pdf'),
            'constitutive_act'  => UploadedFile::fake()->create('constitutive_act.pdf'),
            'bank_cover'        => UploadedFile::fake()->create('bank_cover.pdf'),
        ];

        $this->post('api/affiliates', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data'  => [
                    'commercial_name'   => $data->commercial_name
                ]
            ]);

        $this->assertDatabaseHas('affiliates', [
            'commercial_name'   => $data->commercial_name,
            'business_name'     => $data->business_name,
            'rfc'               => $data->rfc,
            'address'           => $data->address,
            'name'              => $data->name,
            'last_name'         => $data->last_name,
            'email'             => $data->email,
            'phone'             => $data->phone,
            'url'               => substr($data->name, 0, 1).''.$data->last_name,
            'status_id'         => $status->id,
            'points'            => 0,
            'approved_at'       => null,
            'approved_by'       => null,
            'rejected_at'       => null,
            'rejected_by'       => null,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Affiliate::query()->max('id'),
            'fileable_type' => Affiliate::class,
            'name'          => 'identification.pdf',
            'type_id'       => $identification->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Affiliate::query()->max('id'),
            'fileable_type' => Affiliate::class,
            'name'          => 'rcf_photo.pdf',
            'type_id'       => $rfc->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Affiliate::query()->max('id'),
            'fileable_type' => Affiliate::class,
            'name'          => 'address_voucher.pdf',
            'type_id'       => $address->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Affiliate::query()->max('id'),
            'fileable_type' => Affiliate::class,
            'name'          => 'constitutive_act.pdf',
            'type_id'       => $constitutive->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Affiliate::query()->max('id'),
            'fileable_type' => Affiliate::class,
            'name'          => 'bank_cover.pdf',
            'type_id'       => $bank->id,
        ]);
    }

    function test_validate_affiliate_at_store()
    {
        $this->postJson('api/affiliates')
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'commercial_name'   => ['El campo nombre comercial es obligatorio.'],
                    'business_name'     => ['El campo razón social es obligatorio.'],
                    'rfc'               => ['El campo rfc es obligatorio.'],
                    'address'           => ['El campo dirección es obligatorio.'],
                    'name'              => ['El campo nombre es obligatorio.'],
                    'last_name'         => ['El campo apellido es obligatorio.'],
                    'email'             => ['El campo correo electrónico es obligatorio.'],
                    'phone'             => ['El campo teléfono es obligatorio.'],
                    'password'          => ['El campo contraseña es obligatorio.'],
                    'identification'    => ['El campo identificación oficial es obligatorio.'],
                    'rcf_photo'         => ['El campo rfc es obligatorio.'],
                    'address_voucher'   => ['El campo comprobante de domicilio es obligatorio.'],
                ]
            ]);
    }
}
