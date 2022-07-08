<?php

namespace Tests\Feature\Admin;

use App\Models\VehicleSide;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleSideTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicle_sides()
    {
        $this->signIn();

        $side = VehicleSide::factory()->create();

        $this->getJson('/api/admin/vehicle-sides')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $side->id
                    ]
                ]
            ]);
    }

    public function test_search_vehicle_sides_by_name()
    {
        $this->signIn();

        $side         = VehicleSide::factory()->create();
        $otherMake    = VehicleSide::factory()->create();

        $parameters = [
            'search' => $side->name
        ];

        $this->call('GET','/api/admin/vehicle-sides', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $side->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherMake->id
                    ]
                ]
            ]);
    }

    public function test_store_a_vehicle_side()
    {
        $this->signIn();

        $data = VehicleSide::factory()->make();

        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/vehicle-sides/', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sides', [
            'name' => $data->name
        ]);

    }

    public function test_validate_store_a_vehicle_side()
    {
        $this->signIn();

        $data       = VehicleSide::factory()->make();
        $parameters = [];

        $this->postJson('api/admin/vehicle-sides/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                ]
            ]);

    }
    
    public function test_update_a_vehicle_side()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $side = VehicleSide::factory()->create();
        $data = VehicleSide::factory()->make();

        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/vehicle-sides/'.$side->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $side->id
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sides', [
            'id'   => $side->id,
            'name' => $data->name
        ]);

    }

    public function test_validate_update_a_vehicle_side()
    {

        $this->signIn();

        $side       = VehicleSide::factory()->create();
        $parameters = [];

        $this->putJson('api/admin/vehicle-sides/'.$side->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                ]
            ]);

    }
    
    public function test_destroy_a_vehicle_side()
    {

        $this->signIn();

        $side = VehicleSide::factory()->create();

        $this->deleteJson('api/admin/vehicle-sides/'.$side->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('vehicle_sides', [
            'id' => $side->id
        ]);

    }


}
