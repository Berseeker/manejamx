<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_brands()
    {
        $this->signIn();

        $brand = Brand::factory()->create();

        $this->getJson('/api/admin/brands')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $brand->id
                    ]
                ]
            ]);
    }


    public function test_search_brands_by_name()
    {
        $this->signIn();

        $brand     = Brand::factory()->create();
        $otherMake = Brand::factory()->create();

        $parameters = [
            'search' => $brand->name
        ];

        $this->call('GET','/api/admin/brands', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $brand->id
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

    public function test_update_a_make()
    {
        Storage::fake('public');

        $this->signIn();


        $brand = Brand::factory()->create();

        $parameters = [
            'file' => UploadedFile::fake()->image('logo.png'),
        ];

        $this->putJson('api/admin/brands/'.$brand->id, $parameters)
            ->assertJson([
                'data' => [
                    'id' => $brand->id
                ]
            ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => $brand->id,
            'fileable_type' => Brand::class,
            'name'          => 'logo.png',
            'filename'      => 'logo.png',
        ]);
    }

    public function test_update_a_make_validation()
    {
        Storage::fake('public');

        $this->signIn();

        $brand = Brand::factory()->create();

        $parameters = [
            'file' => UploadedFile::fake()->image('logo.pdf'),
        ];

        $this->putJson('api/admin/brands/'.$brand->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'file' => ['Logo debe ser una imagen.']
                ]
            ]);

        $this->assertDatabaseMissing('files', [
            'fileable_id'   => $brand->id,
            'fileable_type' => Brand::class,
            'name'          => 'logo.pdf',
            'filename'      => 'logo.pdf',
        ]);

    }


}
