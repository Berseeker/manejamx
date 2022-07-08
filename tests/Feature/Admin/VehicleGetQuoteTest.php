<?php

namespace Tests\Feature\Admin;

use App\Models\VehicleQuoteRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleGetQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_vehicle_quote_request()
    {
        $this->signIn();

        $quote = VehicleQuoteRequest::factory()->create();

        $this->getJson('/api/admin/vehicles/quote-requests')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'observations' => $quote->observations,
                    ]
                ]
            ]);

    }
    
    public function test_update_vehicle_quote_request()
    {
        $this->signIn();

        $quote = VehicleQuoteRequest::factory()->create();
        $data  = VehicleQuoteRequest::factory()->make();

        $parameters = [
            'answered'     => true,
            'observations' => $data->observations,
        ];

        $this->putJson('/api/admin/vehicles/quote-requests/'.$quote->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'answered'     => true,
                    'observations' => $data->observations,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_quote_requests', [
            'id'           => $quote->id,
            'answered'     => true,
            'observations' => $data->observations,
        ]);
    }


}
