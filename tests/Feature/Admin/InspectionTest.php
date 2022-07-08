<?php

namespace Tests\Feature\Admin;

use App\Models\Inspection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InspectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_inspections()
    {
        $this->signIn();

        $inspections = Inspection::factory()->create();

        $this->getJson('/api/admin/inspections')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $inspections->id
                    ]
                ]
            ]);
    }

    public function test_store_a_inspections()
    {

        $this->signIn();

        $data = Inspection::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/inspections/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('inspections', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_inspection()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/inspections/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_inspection()
    {

        $this->signIn();

        $inspection = Inspection::factory()->create();
        $data       = Inspection::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/inspections/'.$inspection->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $inspection->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('inspections', [
            'id'   => $inspection->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_inspection()
    {
        $this->signIn();
        
        $inspection = Inspection::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/inspections/'.$inspection->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_inspection()
    {
        $this->signIn();
        
        $inspection = Inspection::factory()->create();

        $this->deleteJson('api/admin/inspections/'.$inspection->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('inspections', [
            'id' => $inspection->id
        ]);
    }
    
    public function test_restore_a_inspection()
    {
        $this->signIn();
        
        $inspection = Inspection::factory()->create();
        $inspection->delete();

        $this->putJson('api/admin/inspections/'.$inspection->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('inspections', [
            'id' => $inspection->id
        ]);
    }

}
