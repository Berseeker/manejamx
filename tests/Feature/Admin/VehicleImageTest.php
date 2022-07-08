<?php

namespace Tests\Feature\Admin;

use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\FileType;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleImageTest extends TestCase
{
    use RefreshDatabase;

   
    public function test_store_a_vehicle_image()
    {
        $this->withoutExceptionHandling();
        Storage::fake('public');

        $this->signIn();

        $type = FileType::factory()->create(['id' => FileType::THREE_SIXTY]);
        
        $vehicle = Vehicle::factory()->create();

        $parameters = [
            'type_id'     => $type->id,
            'description' => 'test',
            'file'        => UploadedFile::fake()->image('logo.png'),
        ];

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/images', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $vehicle->id
                ]
            ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => $vehicle->id,
            'fileable_type' => Vehicle::class,
            'type_id'       => $type->id,
            /* 'name'          => 'logo.png',
            'filename'      => 'logo.png', */
            //'description'   => 'test'
        ]);
    
    }
    
    public function test_validate_store_a_vehicle_image()
    {
        $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $parameters = [
            'file' => UploadedFile::fake()->image('logo.pdf'),
        ];

        $this->postJson('api/admin/vehicles/'.$vehicle->id.'/images', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'file' => ['Archivo debe ser una imagen.']
                ]
            ]);

    }
    
    public function test_destroy_a_vehicle_image()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $vehicle = Vehicle::factory()->create();
        
        $file = File::factory()->create([
            'fileable_id'   => $vehicle->id,
            'fileable_type' => Vehicle::class,
        ]);

        $this->deleteJson('api/admin/vehicles/'.$vehicle->id.'/images/'.$file->id)
            ->assertStatus(200);

        $this->assertSoftDeleted('files', [
            'id' => $file->id
        ]);

    }

}
