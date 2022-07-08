<?php

namespace Tests\Feature\Admin;

use App\Models\Color;
use App\Models\Cylinder;
use App\Models\Drive;
use App\Models\Fuel;
use App\Models\Transmission;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleDetailTest extends TestCase
{
    use RefreshDatabase;
   
    public function test_store_a_vehicle_details()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $parameters = [
            'transmissions'   => [$transmission = Transmission::factory()->create()->id],
            'cylinders'       => [$cylinder = Cylinder::factory()->create()->id],
            'fuels'           => [$fuel = Fuel::factory()->create()->id],
            'colors'          => [$color = Color::factory()->create()->id],
            'interior_colors' => [$interiorColor = Color::factory()->create()->id],
            'drives'          => [$drive = Drive::factory()->create()->id],
        ];

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/details', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);

        $this->assertDatabaseHas('transmission_vehicle', [
            'vehicle_id' => $vehicle->id,
            'transmission_id' => $transmission
        ]);

        $this->assertDatabaseHas('cylinder_vehicle', [
            'vehicle_id' => $vehicle->id,
            'cylinder_id' => $cylinder
        ]);

        $this->assertDatabaseHas('fuel_vehicle', [
            'vehicle_id' => $vehicle->id,
            'fuel_id' => $fuel
        ]);
        
        $this->assertDatabaseHas('drive_vehicle', [
            'vehicle_id' => $vehicle->id,
            'drive_id'   => $drive
        ]);

        $this->assertDatabaseHas('color_vehicle', [
            'vehicle_id' => $vehicle->id,
            'color_id' => $color
        ]);
        
        $this->assertDatabaseHas('interior_color_vehicle', [
            'vehicle_id' => $vehicle->id,
            'color_id'   => $interiorColor
        ]);

    }
    
    public function test_validate_store_a_vehicle_details()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/details', [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'transmissions'    => ['El campo transmisión es obligatorio.'],
                    'cylinders'        => ['El campo cilindraje es obligatorio.'],
                    'fuels'            => ['El campo combustible es obligatorio.'],
                    'colors'           => ['El campo color es obligatorio.'],
                    'interior_colors'  => ['El campo color del interior es obligatorio.'],
                    'drives'           => ['El campo tracción es obligatorio.'],
                ]
            ]);

    }

}
