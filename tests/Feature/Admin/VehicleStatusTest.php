<?php

namespace Tests\Feature\Admin;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicle_statuses()
    {
        $this->signIn();

        $vehicleStatus = VehicleStatus::factory()->create();

        $this->getJson('/api/admin/vehicle-statuses')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicleStatus->id
                    ]
                ]
            ]);
    }   

}
