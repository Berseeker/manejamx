<?php

namespace Tests\Feature\Admin;

use App\Models\Fuel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FuelTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_fuels()
    {
        $this->signIn();

        $fuel = Fuel::factory()->create();

        $this->getJson('/api/admin/fuels')
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
        $this->signIn();

        $fuel       = Fuel::factory()->create();
        $otherType  = Fuel::factory()->create();

        $parameters = [
            'search' => $fuel->name
        ];

        $this->call('GET','/api/admin/fuels', $parameters)
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

    public function test_store_a_fuels()
    {

        $this->signIn();

        $data = Fuel::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/fuels/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('fuels', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_fuels()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/fuels/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_fuels()
    {

        $this->signIn();

        $fuel = Fuel::factory()->create();
        $data = Fuel::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/fuels/'.$fuel->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $fuel->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('fuels', [
            'id'   => $fuel->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_fuels()
    {
        $this->signIn();
        
        $fuel = Fuel::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/fuels/'.$fuel->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_fuels()
    {
        $this->signIn();
        
        $fuel = Fuel::factory()->create();

        $this->deleteJson('api/admin/fuels/'.$fuel->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('fuels', [
            'id' => $fuel->id
        ]);
    }
    
    public function test_restore_a_fuels()
    {
        $this->signIn();
        
        $fuel = Fuel::factory()->create();

        $fuel->delete();

        $this->putJson('api/admin/fuels/'.$fuel->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('fuels', [
            'id' => $fuel->id
        ]);
    }

}
