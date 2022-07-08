<?php

namespace Tests\Feature\Admin;

use App\Models\AccessoryType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessoryTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_accessory_types()
    {
        $this->signIn();

        $type = AccessoryType::factory()->create();

        $this->getJson('/api/admin/accessory-types')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $type->id
                    ]
                ]
            ]);
    }
    
    public function test_search_accessory_types_by_name()
    {
        $this->signIn();

        $type       = AccessoryType::factory()->create();
        $otherType  = AccessoryType::factory()->create();

        $parameters = [
            'search' => $type->name
        ];

        $this->call('GET','/api/admin/accessory-types', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $type->id
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

    public function test_store_a_accessory_types()
    {

        $this->signIn();

        $data = AccessoryType::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/accessory-types/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('accessory_types', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_accessory_types()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/accessory-types/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_accessory_types()
    {

        $this->signIn();

        $type = AccessoryType::factory()->create();
        $data = AccessoryType::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/accessory-types/'.$type->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $type->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('accessory_types', [
            'id'   => $type->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_accessory_types()
    {
        $this->signIn();
        
        $type = AccessoryType::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/accessory-types/'.$type->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_accessory_types()
    {
        $this->signIn();
        
        $type = AccessoryType::factory()->create();

        $this->deleteJson('api/admin/accessory-types/'.$type->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('accessory_types', [
            'id' => $type->id
        ]);
    }
    
    public function test_restore_a_accessory_types()
    {
        $this->signIn();
        
        $type = AccessoryType::factory()->create();
        $type->delete();

        $this->putJson('api/admin/accessory-types/'.$type->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('accessory_types', [
            'id' => $type->id
        ]);
    }

}
