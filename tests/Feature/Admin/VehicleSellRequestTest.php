<?php

namespace Tests\Feature\Admin;

use App\Models\VehicleSellRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleSellRequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicle_sell_request()
    {
        $this->signIn();

        $sell = VehicleSellRequest::factory()->create();

        $this->getJson('/api/admin/vehicles/sell-requests')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $sell->id,
                    ]
                ]
            ]);

    }
    
    public function test_update_vehicle_sell_request()
    {
        $this->signIn();

        $sell = VehicleSellRequest::factory()->create();
        $data  = VehicleSellRequest::factory()->make();

        $parameters = [
            'answered'     => true,
            'observations' => $data->observations,
        ];

        $this->putJson('/api/admin/vehicles/sell-requests/'.$sell->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'answered'     => true,
                    'observations' => $data->observations,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_sell_requests', [
            'id'           => $sell->id,
            'answered'     => true,
            'observations' => $data->observations,
        ]);
    }


}
