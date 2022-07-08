<?php

namespace Tests\Feature\Admin;

use App\Models\Cylinder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CylinderTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_cylinders()
    {
        $this->signIn();

        $cylinders = Cylinder::factory()->create();

        $this->getJson('/api/admin/cylinders')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $cylinders->id
                    ]
                ]
            ]);
    }
    

    public function test_search_cylinders_by_name()
    {
        $this->signIn();

        $cylinders      = Cylinder::factory()->create();
        $otherCylinder  = Cylinder::factory()->create();

        $parameters = [
            'search' => $cylinders->name
        ];

        $this->call('GET','/api/admin/cylinders', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $cylinders->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherCylinder->id
                    ]
                ]
            ]);
    }

    public function test_store_a_cylinders()
    {

        $this->signIn();

        $data = Cylinder::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/cylinders/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('cylinders', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_cylinders()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/cylinders/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_cylinders()
    {

        $this->signIn();

        $cylinders = Cylinder::factory()->create();
        $data      = Cylinder::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/cylinders/'.$cylinders->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $cylinders->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('cylinders', [
            'id'   => $cylinders->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_cylinders()
    {
        $this->signIn();
        
        $cylinders = Cylinder::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/cylinders/'.$cylinders->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_cylinders()
    {
        $this->signIn();
        
        $cylinders = Cylinder::factory()->create();

        $this->deleteJson('api/admin/cylinders/'.$cylinders->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('cylinders', [
            'id' => $cylinders->id
        ]);
    }

    public function test_restore_a_cylinder()
    {
        $this->signIn();
        
        $cylinder = cylinder::factory()->create();

        $cylinder->delete();

        $this->putJson('api/admin/cylinders/'.$cylinder->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('cylinders', [
            'id' => $cylinder->id
        ]);
    }

}
