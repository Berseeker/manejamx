<?php

namespace Tests\Feature\Admin;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicles()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->getJson('/api/admin/vehicles')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id'        => $vehicle->id,
                        'affiliate' => [],
                    ]
                ]
            ]);
    }

    public function test_filter_vehicles_by_brand_id()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle_a = Vehicle::factory()->create();

        $vehicle_b = Vehicle::factory()->create();

        $parameters = [
            'brand_id' => [$vehicle_a->brand->id]
        ];

        $this->call('GET', '/api/admin/vehicles', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicle_a->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $vehicle_b->id
                    ]
                ]
            ]);
    }

    public function test_filter_vehicles_by_model_id()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle_a = Vehicle::factory()->create();

        $vehicle_b = Vehicle::factory()->create();

        $parameters = [
            'model_id' => [$vehicle_a->model->id]
        ];

        $this->call('GET', '/api/admin/vehicles', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicle_a->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $vehicle_b->id
                    ]
                ]
            ]);
    }

    public function test_store_a_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->withoutExceptionHandling();
        $this->signIn();

        $vehicle = Vehicle::factory()->make();

        $parameters = [
            'brand_id'          => $vehicle->brand->id,
            'model_id'          => $vehicle->model->id,
            'version_id'        => $vehicle->version->id,
            'year'              => $vehicle->year,
            'odometer'          => $vehicle->odometer,
            'sell_price'        => $vehicle->sell_price,
            'vin'               => $vehicle->vin,
            'doors'             => $vehicle->doors,
            'keys'              => $vehicle->keys,
            'body_type_id'      => $vehicle->body_type_id,
            'fuel_consumption'  => $vehicle->fuel_consumption,
            'description'       => $vehicle->description,
        ];

        $this->postJson('api/admin/vehicles/', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'year'       => $vehicle->year,
                    'sell_price' => $vehicle->sell_price,
                ]
            ]);

        $this->assertDatabaseHas('vehicles', [
            'brand_id'          => $vehicle->brand->id,
            'model_id'          => $vehicle->model->id,
            'version_id'        => $vehicle->version->id,
            'year'              => $vehicle->year,
            'sell_price'        => $vehicle->sell_price,
            'vin'               => $vehicle->vin,
            'doors'             => $vehicle->doors,
            'keys'              => $vehicle->keys,
            'odometer'          => $vehicle->odometer,
            'body_type_id'      => $vehicle->body_type_id,
            'fuel_consumption'  => $vehicle->fuel_consumption,
            'description'       => $vehicle->description,
        ]);

    }

    public function test_validate_store_a_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $this->postJson('api/admin/vehicles/', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'brand_id'     => ['El campo marca es obligatorio.'],
                    'model_id'     => ['El campo modelo es obligatorio.'],
                    'version_id'   => ['El campo versión es obligatorio.'],
                    'body_type_id' => ['El campo tipo de carroceria es obligatorio.'],
                    'year'         => ['El campo año es obligatorio.'],
                    'sell_price'   => ['El campo precio de venta es obligatorio.'],
                ]
            ]);

    }

    public function test_update_a_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle = Vehicle::factory()->create();
        $data    = Vehicle::factory()->make();

        $parameters = [
            'brand_id'          => $data->brand->id,
            'model_id'          => $data->model->id,
            'version_id'        => $data->version->id,
            'year'              => $data->year,
            'sell_price'        => $data->sell_price,
            'vin'               => $data->vin,
            'odometer'          => $data->odometer,
            'doors'             => $data->doors,
            'keys'              => $data->keys,
            'body_type_id'      => $data->body_type_id,
            'fuel_consumption'  => $data->fuel_consumption,
            'description'       => $data->description,
        ];

        $this->putJson('api/admin/vehicles/'.$vehicle->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'year'       => $data->year,
                    'sell_price' => $data->sell_price,
                ]
            ]);

        $this->assertDatabaseHas('vehicles', [
            'id'                => $vehicle->id,
            'brand_id'          => $data->brand->id,
            'model_id'          => $data->model->id,
            'version_id'        => $data->version->id,
            'year'              => $data->year,
            'odometer'          => $data->odometer,
            'sell_price'        => $data->sell_price,
            'vin'               => $data->vin,
            'doors'             => $data->doors,
            'keys'              => $data->keys,
            'body_type_id'      => $data->body_type_id,
            'fuel_consumption'  => $data->fuel_consumption,
            'description'       => $data->description,
        ]);

    }

    public function test_validate_update_a_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->putJson('api/admin/vehicles/'.$vehicle->id, [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'brand_id'   => ['El campo marca es obligatorio.'],
                    'model_id'   => ['El campo modelo es obligatorio.'],
                    'version_id' => ['El campo versión es obligatorio.'],
                    'year'       => ['El campo año es obligatorio.'],
                    'sell_price' => ['El campo precio de venta es obligatorio.'],
                ]
            ]);
    }

    public function test_destroy_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->assertDatabaseHas('vehicles', [
            'id' => $vehicle->id
        ]);

        $this->delete('/api/admin/vehicles/' . $vehicle->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('vehicles', [
            'id' => $vehicle->id
        ]);
    }

    public function test_active_deactive_a_vehicle()
    {
        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->signIn();

        $vehicle = Vehicle::factory()->create([
            'active' => false
        ]);

        $this->putJson('api/admin/vehicles/'.$vehicle->id.'/activations')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id'     => $vehicle->id,
                    'active' => true,
                ]
            ]);

        $this->assertDatabaseHas('vehicles', [
            'id'           => $vehicle->id,
            'active'       => true
        ]);

    }

}
