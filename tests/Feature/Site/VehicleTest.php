<?php

namespace Tests\Feature\Site;

use App\Models\Affiliate;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicles()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $vehicle = Vehicle::factory()->create(['active' => true]);

        $this->getJson('/api/vehicles')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $vehicle->id
                    ]
                ]
            ]);
    }

    public function test_filter_vehicles_by_affiliate()
    {
        $this->signIn();

        $affiliate = Affiliate::factory()->create(['url' => 'test']);

        $vehicle_a = Vehicle::factory()->create([
            'active'        => true,
            'affiliate_id'  => $affiliate->id,
        ]);

        $vehicle_b = Vehicle::factory()->create([
            'active'        => true,
            'affiliate_id'  => null
        ]);

        $parameters = [
            'affiliate' => $affiliate->url
        ];

        $this->call('GET', '/api/vehicles', $parameters)
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

    public function test_filter_vehicles_by_brand_id()
    {
        $this->signIn();

        $vehicle_a = Vehicle::factory()->create(['active' => true]);

        $vehicle_b = Vehicle::factory()->create(['active' => true]);

        $parameters = [
            'brand_id' => [$vehicle_a->brand->id]
        ];

        $this->call('GET', '/api/vehicles', $parameters)
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
        $this->signIn();

        $vehicle_a = Vehicle::factory()->create(['active' => true]);

        $vehicle_b = Vehicle::factory()->create(['active' => true]);

        $parameters = [
            'model_id' => [$vehicle_a->model->id]
        ];

        $this->call('GET', '/api/vehicles', $parameters)
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

    public function test_show_vehicle()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create(['active' => true]);

        $this->getJson('/api/vehicles/'.$vehicle->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);
    }
}
