<?php

namespace Tests\Feature\Site;

use App\Models\Fuel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FuelTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_fuels()
    {

        $fuel = Fuel::factory()->create();

        $this->getJson('/api/fuels')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $fuel->id
                    ]
                ]
            ]);
    }
    
    public function test_search_fuels_by_name()
    {

        $fuel       = Fuel::factory()->create();
        $otherType  = Fuel::factory()->create();

        $parameters = [
            'search' => $fuel->name
        ];

        $this->call('GET','/api/fuels', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $fuel->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherType->id
                    ]
                ]
            ]);
    }

}
