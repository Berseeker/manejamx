<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\Model;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VersionTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_versions()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $version = Version::factory()->create();

        $this->getJson('/api/admin/versions')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $version->id
                    ]
                ]
            ]);
    }

    public function test_filter_models_by_brand_id()
    {
        $this->signIn();

        $brand_a = Brand::factory()->create();
        $model_a = Model::factory()->create([
            'brand_id' => $brand_a->id
        ]);
        $version_a = Version::factory()->create([
            'model_id' => $model_a->id
        ]);

        $brand_b = Brand::factory()->create();
        $model_b = Model::factory()->create([
            'brand_id' => $brand_b->id
        ]);
        $version_b = Version::factory()->create([
            'model_id' => $model_b->id
        ]);

        $parameters = [
            'brand_id' => [$brand_a->id]
        ];

        $this->call('GET', '/api/admin/versions', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $version_a->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $version_b->id
                    ]
                ]
            ]);
    }

    public function test_filter_models_by_model_id()
    {
        $this->signIn();

        $model_a = Model::factory()->create();
        $version_a = Version::factory()->create([
            'model_id' => $model_a->id
        ]);

        $model_b = Model::factory()->create();
        $version_b = Version::factory()->create([
            'model_id' => $model_b->id
        ]);

        $parameters = [
            'model_id' => [$model_a->id]
        ];

        $this->call('GET', '/api/admin/versions', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $version_a->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $version_b->id
                    ]
                ]
            ]);
    }

    public function test_update_a_version()
    {
        $this->signIn();

        $version = Version::factory()->create([
            'name'      => 'bar',
            'year'      => '2001',
            'sell'      => '123',
            'buy'       => '321',
            'currency'  => 'MXN',
        ]);

        $this->assertDatabaseHas('versions', [
            'id'   => $version->id,
            'name' => 'bar',
            'year'      => '2001',
            'sell'      => '123',
            'buy'       => '321',
            'currency'  => 'MXN',
        ]);

        $parameters = [
            'name'      => 'foo',
            'year'      => '2020',
            'sell'      => '321',
            'buy'       => '123',
            'currency'  => 'MXN',
        ];

        $this->putJson('api/admin/versions/'.$version->id, $parameters)
            ->assertJson([
                'data' => [
                    'id' => $version->id
                ]
            ]);

        $this->assertDatabaseHas('versions', [
            'id'   => $version->id,
            'name'      => 'foo',
            'year'      => '2020',
            'sell'      => '321',
            'buy'       => '123',
            'currency'  => 'MXN',
        ]);
    }

    public function test_update_a_model_validation()
    {
        $this->signIn();

        $version = Version::factory()->create();

        $this->assertDatabaseHas('versions', [
            'id'   => $version->id
        ]);

        $this->putJson('api/admin/versions/'.$version->id, [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name'      => ['El campo Nombre es obligatorio.'],
                    'year'      => ['El campo Año es obligatorio.'],
                    'sell'      => ['El campo P. Venta es obligatorio.'],
                    'buy'       => ['El campo P. Compra es obligatorio.'],
                    'currency'  => ['El campo Moneda es obligatorio.'],
                ]
            ]);
    }

}
