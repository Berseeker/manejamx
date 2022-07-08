<?php

namespace Tests\Feature\Site;

use App\Models\VehicleQuoteRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleGetQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_vehicle_quote_request()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $data = VehicleQuoteRequest::factory()->create();

        $parameters = [
            'name'        => $data->name,
            'last_name'   => $data->last_name,
            'phone'       => $data->phone,
            'email'       => $data->email,
            'description' => $data->description,
            'date'        => $data->date,
            'time'        => $data->time,
        ];

        $this->postJson('/api/vehicles/'.$data->vehicle_id.'/quote-requests', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name'        => $data->name,
                    'last_name'   => $data->last_name,
                ]
            ]);

        $this->assertDatabaseHas('vehicle_quote_requests', $parameters);
    }

    public function test_validate_store_vehicle_quote_request()
    {
        $this->signIn();

        $data = VehicleQuoteRequest::factory()->create();

        $parameters = [];

        $this->postJson('/api/vehicles/'.$data->vehicle_id.'/quote-requests', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'      => ['El campo nombre es obligatorio.'],
                    'last_name' => ['El campo apellido es obligatorio.'],
                    'email'     => ['El campo correo electrónico es obligatorio.'],
                    'phone'     => ['El campo teléfono es obligatorio.'],
                ]
            ]);

    }

}
