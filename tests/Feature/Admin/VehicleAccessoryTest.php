<?php

namespace Tests\Feature\Admin;

use App\Models\Accessory;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleAccessoryTest extends TestCase
{
    use RefreshDatabase;

   
    public function test_store_a_vehicle_accessories()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $parameters = [
            'accessories' => [$accessory = Accessory::factory()->create()->id],
        ];

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/accessories', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);

        $this->assertDatabaseHas('accessory_vehicle', [
            'vehicle_id'   => $vehicle->id,
            'accessory_id' => $accessory
        ]);

    
    }
    
    public function test_validate_store_a_vehicle_accessories()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/accessories', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'accessories' => ['El campo accesorios es obligatorio.'],
                ]
            ]);

    }

}
