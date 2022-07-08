<?php

namespace Tests\Feature\Site;

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
        $this->signIn();

        $version = Version::factory()->create();

        $this->getJson('/api/versions')
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

        $this->call('GET', '/api/versions', $parameters)
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

        $this->call('GET', '/api/versions', $parameters)
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

}
