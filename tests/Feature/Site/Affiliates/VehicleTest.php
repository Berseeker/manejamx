<?php

namespace Tests\Feature\Site\Affiliates;

use App\Models\Affiliate;
use App\Models\AffiliateVehicle;
use App\Models\AffiliateVehicleColor;
use App\Models\Color;
use App\Models\Status;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    function test_list_vehicles()
    {
        $affiliate = Affiliate::factory()->create();
        $user = $this->signIn(['affiliate_id' => $affiliate->id]);

        $vehicle = AffiliateVehicle::factory()->create([
            'user_id'       => $user->id,
            'affiliate_id'  => $affiliate->id,
        ]);

        $this->get('api/site/affiliates/vehicles')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0   => [
                        'id'        => $vehicle->id,
                        'brand'     => [],
                        'model'     => [],
                        'version'   => [],
                        'status'    => [],
                    ]
                ]
            ]);

    }

    function test_store_a_vehicle_as_affiliate()
    {
        Storage::fake();

        $status = Status::factory()->create(['id' => Status::IN_PROCESS]);

        $affiliate = Affiliate::factory()->create();
        $user = $this->signIn(['affiliate_id' => $affiliate->id]);

        $data = Vehicle::factory()->make();
        $color = Color::factory()->create();

        $parameters = [
            'brand_id'        => $data->brand_id,
            'model_id'        => $data->model_id,
            'version_id'      => $data->version_id,
            'year'            => $data->year,
            'odometer'        => $data->odometer,
            'sell_price'      => $data->sell_price,
            'colors'          => [$color->id],
            'interior_colors' => [$color->id],
            'file'            => UploadedFile::fake()->image('test.jpg'),
        ];

        $this->postJson('/api/site/affiliates/vehicles', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'year'  => $data->year
                ]
            ]);

        $this->assertDatabaseHas('affiliate_vehicles', [
            'brand_id'      => $data->brand_id,
            'model_id'      => $data->model_id,
            'version_id'    => $data->version_id,
            'year'          => $data->year,
            'odometer'      => $data->odometer,
            'sell_price'    => $data->sell_price,
            'user_id'       => $user->id,
            'affiliate_id'  => $affiliate->id,
            'status_id'     => $status->id,
        ]);

        $this->assertDatabaseHas('affiliate_vehicle_colors', [
            'vehicle_id'    => AffiliateVehicle::query()->max('id'),
            'color_id'      => $color->id,
            'exterior'      => false,
            'interior'      => true,
        ]);

        $this->assertDatabaseHas('affiliate_vehicle_colors', [
            'vehicle_id'    => AffiliateVehicle::query()->max('id'),
            'color_id'      => $color->id,
            'exterior'      => true,
            'interior'      => false,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => AffiliateVehicle::query()->max('id'),
            'fileable_type' => AffiliateVehicle::class,
            'name'          => 'test.jpg',
            'filename'      => 'test.jpg',
        ]);
    }

    function test_validate_vehicle_at_store()
    {
        $this->signIn();

        $this->postJson('/api/site/affiliates/vehicles')
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'brand_id'        => ['El campo marca es obligatorio.'],
                    'model_id'        => ['El campo modelo es obligatorio.'],
                    'version_id'      => ['El campo versión es obligatorio.'],
                    'year'            => ['El campo año es obligatorio.'],
                    'odometer'        => ['El campo kilometraje es obligatorio.'],
                    'sell_price'      => ['El campo precio de venta es obligatorio.'],
                    'colors'          => ['El campo color es obligatorio.'],
                    'interior_colors' => ['El campo color del interior es obligatorio.'],
                    'file'            => ['El campo fotografía es obligatorio.'],
                ]
            ]);
    }
}
