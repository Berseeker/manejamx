<?php

namespace Tests\Feature\Admin;

use App\Models\Transmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_transmissions()
    {
        $this->signIn();

        $transmission = Transmission::factory()->create();

        $this->getJson('/api/admin/transmissions')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $transmission->id
                    ]
                ]
            ]);
    }
    

    public function test_search_transmissions_by_name()
    {
        $this->signIn();

        $transmission      = Transmission::factory()->create();
        $otherTransmission = Transmission::factory()->create();

        $parameters = [
            'search' => $transmission->name
        ];

        $this->call('GET','/api/admin/transmissions', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $transmission->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherTransmission->id
                    ]
                ]
            ]);
    }

    public function test_store_a_transmission()
    {

        $this->signIn();

        $data = Transmission::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/transmissions/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('transmissions', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_transmission()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/transmissions/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_transmission()
    {

        $this->signIn();

        $transmission = Transmission::factory()->create();
        $data         = Transmission::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/transmissions/'.$transmission->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $transmission->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('transmissions', [
            'id'   => $transmission->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_transmission()
    {
        $this->signIn();
        
        $transmission = Transmission::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/transmissions/'.$transmission->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_transmission()
    {
        $this->signIn();
        
        $transmission = Transmission::factory()->create();

        $this->deleteJson('api/admin/transmissions/'.$transmission->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('transmissions', [
            'id' => $transmission->id
        ]);
    }
    
    public function test_restore_a_transmission()
    {
        $this->withoutExceptionHandling();
        $this->signIn();
        
        $transmission = Transmission::factory()->create();

        $transmissionId = $transmission->id;

        $transmission->delete();

        $this->putJson('api/admin/transmissions/'.$transmission->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('transmissions', [
            'id' => $transmission->id
        ]);
    }

}
