<?php

namespace Tests\Feature\Admin;

use App\Models\BodyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class BodyTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_body_types()
    {
        $this->signIn();

        $bodyType = BodyType::factory()->create();

        $this->getJson('/api/admin/body-types')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $bodyType->id
                    ]
                ]
            ]);
    }

    public function test_search_body_types_by_name()
    {
        $this->signIn();

        $bodyType     = BodyType::factory()->create();
        $otherMake    = BodyType::factory()->create();

        $parameters = [
            'search' => $bodyType->name
        ];

        $this->call('GET','/api/admin/body-types', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $bodyType->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherMake->id
                    ]
                ]
            ]);
    }

    public function test_store_a_body_type()
    {
        Storage::fake('public');

        $this->signIn();

        $data = BodyType::factory()->make();

        $parameters = [
            'name' => $data->name,
            'file' => UploadedFile::fake()->image('test.png'),
        ];

        $this->postJson('api/admin/body-types/', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $data->name
                ]
            ]);

        $this->assertDatabaseHas('body_types', [
            'name' => $data->name
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => BodyType::max('id'),
            'fileable_type' => BodyType::class,
            'name'          => 'test.png',
            'filename'      => 'test.png',
        ]);

    }

    public function test_validate_store_a_body_type()
    {
        Storage::fake('public');

        $this->signIn();

        $data       = BodyType::factory()->make();

        $parameters = [];

        $this->postJson('api/admin/body-types/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                    'file' => ['El campo archivo es obligatorio.']
                ]
            ]);

    }
    
    public function test_update_a_body_type()
    {
        Storage::fake('public');

        $this->signIn();


        $bodyType = BodyType::factory()->create();
        $data     = BodyType::factory()->make();

        $parameters = [
            'name' => $data->name,
            'file' => UploadedFile::fake()->image('test.png'),
        ];

        $this->putJson('api/admin/body-types/'.$bodyType->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $bodyType->id
                ]
            ]);

        $this->assertDatabaseHas('body_types', [
            'id'   => $bodyType->id,
            'name' => $data->name
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => $bodyType->id,
            'fileable_type' => BodyType::class,
            'name'          => 'test.png',
            'filename'      => 'test.png',
        ]);

    }

    public function test_validate_update_a_body_type()
    {
        Storage::fake('public');

        $this->signIn();

        $bodyType = BodyType::factory()->create();

        $parameters = [];

        $this->putJson('api/admin/body-types/'.$bodyType->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                ]
            ]);

    }
    
    public function test_destroy_a_body_type()
    {

        $this->signIn();

        $bodyType = BodyType::factory()->create();

        $this->deleteJson('api/admin/body-types/'.$bodyType->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('body_types', [
            'id' => $bodyType->id
        ]);

    }
    
    public function test_restore_a_body_type()
    {

        $this->signIn();

        $bodyType = BodyType::factory()->create();

        $this->putJson('api/admin/body-types/'.$bodyType->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('body_types', [
            'id' => $bodyType->id
        ]);

    }


}
