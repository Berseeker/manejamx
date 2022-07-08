<?php

namespace Tests\Feature\Admin;

use App\Models\Brand;
use App\Models\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_models()
    {
        $this->signIn();

        $model = Model::factory()->create();

        $this->getJson('/api/admin/models')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $model->id
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

        $brand_b = Brand::factory()->create();
        $model_b = Model::factory()->create([
            'brand_id' => $brand_b->id
        ]);

        $parameters = [
            'brand_id' => [$brand_a->id]
        ];

        $this->call('GET', '/api/admin/models', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $model_a->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $model_b->id
                    ]
                ]
            ]);
    }

    public function test_update_a_model()
    {
        $this->signIn();

        $model = Model::factory()->create([
            'name' => 'bar'
        ]);

        $this->assertDatabaseHas('models', [
            'id'   => $model->id,
            'name' => 'bar'
        ]);

        $parameters = [
            'name' => 'foo',
        ];

        $this->putJson('api/admin/models/'.$model->id, $parameters)
            ->assertJson([
                'data' => [
                    'id' => $model->id
                ]
            ]);

        $this->assertDatabaseHas('models', [
            'id'   => $model->id,
            'name' => 'foo'
        ]);
    }

    public function test_update_a_model_validation()
    {
        $this->signIn();

        $model = Model::factory()->create();

        $this->assertDatabaseHas('models', [
            'id'   => $model->id
        ]);

        $this->putJson('api/admin/models/'.$model->id, [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo Nombre es obligatorio.']
                ]
            ]);
    }

}
