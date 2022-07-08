<?php

namespace Tests\Feature\Admin;

use App\Models\Inspection;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleInspectionTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_store_a_vehicle_inspection()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $inspection = Inspection::factory()->create();

        $parameters = [
            'inspections' => [$inspection->id],
        ];

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/inspections', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);

        $this->assertDatabaseHas('inspection_vehicle', [
            'vehicle_id'   => $vehicle->id,
            'inspection_id' => $inspection['id']
        ]);
    }
    
    public function test_validate_store_a_vehicle_inspection()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/inspections', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'inspections' => ['Debe elegir por lo menos una opción.'],
                ]
            ]);
    }

}
