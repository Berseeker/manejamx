<?php

namespace Tests\Feature\Admin;

use App\Models\Drive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriveTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_drives()
    {
        $this->signIn();

        $drives = Drive::factory()->create();

        $this->getJson('/api/admin/drives')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $drives->id
                    ]
                ]
            ]);
    }
    

    public function test_search_drives_by_name()
    {
        $this->signIn();

        $drives      = Drive::factory()->create();
        $otherDrive  = Drive::factory()->create();

        $parameters = [
            'search' => $drives->name
        ];

        $this->call('GET','/api/admin/drives', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $drives->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherDrive->id
                    ]
                ]
            ]);
    }

    public function test_store_a_drives()
    {

        $this->signIn();

        $data = Drive::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->postJson('api/admin/drives/', $parameters)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('drives', [
            'name' => $data->name
        ]);
    }
    
    public function test_validate_store_drives()
    {

        $this->signIn();
        
        $parameters = [];

        $this->postJson('api/admin/drives/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    public function test_update_a_drives()
    {

        $this->signIn();

        $drives = Drive::factory()->create();
        $data      = Drive::factory()->make();
        
        $parameters = [
            'name' => $data->name,
        ];

        $this->putJson('api/admin/drives/'.$drives->id, $parameters)
            ->assertJson([
                'data' => [
                    'id'   => $drives->id,
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('drives', [
            'id'   => $drives->id,
            'name' => $data->name
        ]);

    }
    
    public function test_validate_update_a_drives()
    {
        $this->signIn();
        
        $drives = Drive::factory()->create();
        $parameters   = [];

        $this->putJson('api/admin/drives/'.$drives->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.']
                ]
            ]);
    }
    
    public function test_destroy_a_drives()
    {
        $this->signIn();
        
        $drives = Drive::factory()->create();

        $this->deleteJson('api/admin/drives/'.$drives->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('drives', [
            'id' => $drives->id
        ]);
    }
    
    public function test_restore_a_drives()
    {
        $this->signIn();
        
        $drives = Drive::factory()->create();
        $drives->delete();

        $this->putJson('api/admin/drives/'.$drives->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('drives', [
            'id' => $drives->id
        ]);
    }

}
