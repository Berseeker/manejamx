<?php

namespace Tests\Feature\Admin;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeVehicleStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_change_vehicle_status()
    {
        $this->signIn();

        VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);
        VehicleStatus::factory()->create(['id' => VehicleStatus::SOLD]);

        $vehicle = Vehicle::factory()->create();

        $parameters = [
            'status_id' => VehicleStatus::SOLD,
        ];

        $this->putJson('/api/admin/vehicles/'.$vehicle->id.'/change-statuses', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);
        
        $this->assertDatabaseHas('vehicles', [
            'id'        => $vehicle->id,
            'status_id' => VehicleStatus::SOLD
        ]);
    }   

}
