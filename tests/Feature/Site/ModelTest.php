<?php

namespace Tests\Feature\Site;

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

        $this->getJson('/api/models')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $model->id
                    ]
                ]
            ]);
    }

}
