<?php

namespace Tests\Feature\Admin;

use App\Models\Accessory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_accessories()
    {
        $this->signIn();

        $accessory = Accessory::factory()->create();

        $this->getJson('/api/admin/accessories')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $accessory->id
                    ]
                ]
            ]);
    }
    
    public function test_search_accessory_by_name()
    {
        $this->signIn();

        $accessory  = Accessory::factory()->create();
        $otherType  = Accessory::factory()->create();

        $parameters = [
            'search' => $accessory->name
        ];

        $this->call('GET','/api/admin/accessories', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $accessory->id
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

    public function test_store_a_accessory()
    {

        $this->signIn();

        $data = Accessory::factory()->make();
        
        $parameters = [
            'name'    => $data->name,
            'type_id' => $data->type_id,
        ];

        $this->postJson('api/admin/accessories/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('accessories', [
            'name'    => $data->name,
            'type_id' => $data->type_id,
        ]);
    }
    
    public function test_validate_store_accessory()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/accessories/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'    => ['El campo nombre es obligatorio.'],
                    'type_id' => ['El campo tipo es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_accessory()
    {

        $this->signIn();

        $accessory = Accessory::factory()->create();
        $data      = Accessory::factory()->make();
        
        $parameters = [
            'name'    => $data->name,
            'type_id' => $data->type_id,
        ];

        $this->putJson('api/admin/accessories/'.$accessory->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $accessory->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('accessories', [
            'id'      => $accessory->id,
            'name'    => $data->name,
            'type_id' => $data->type_id,
        ]);

    }
    
    public function test_validate_update_a_accessory()
    {
        $this->signIn();
        
        $accessory = Accessory::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/accessories/'.$accessory->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'    => ['El campo nombre es obligatorio.'],
                    'type_id' => ['El campo tipo es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_accessory()
    {
        $this->signIn();
        
        $accessory = Accessory::factory()->create();

        $this->deleteJson('api/admin/accessories/'.$accessory->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('accessories', [
            'id' => $accessory->id
        ]);
    }
    
    public function test_restore_a_accessory()
    {
        $this->signIn();
        
        $accessory = Accessory::factory()->create();

        $accessory->delete();

        $this->putJson('api/admin/accessories/'.$accessory->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('accessories', [
            'id' => $accessory->id
        ]);
    }

}
