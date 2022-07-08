<?php

namespace Tests\Feature\Site;

use App\Models\VehicleSide;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleSideTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_body_types()
    {

        $vehicleSide = VehicleSide::factory()->create();

        $this->getJson('/api/vehicle-sides')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicleSide->id
                    ]
                ]
            ]);
    }

    public function test_search_body_types_by_name()
    {

        $vehicleSide  = VehicleSide::factory()->create();
        $otherMake    = VehicleSide::factory()->create();

        $parameters = [
            'search' => $vehicleSide->name
        ];

        $this->call('GET','/api/vehicle-sides', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicleSide->id
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


}
