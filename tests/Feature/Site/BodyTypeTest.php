<?php

namespace Tests\Feature\Site;

use App\Models\BodyType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BodyTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_body_types()
    {

        $bodyType = BodyType::factory()->create();

        $this->getJson('/api/body-types')
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

        $bodyType     = BodyType::factory()->create();
        $otherMake    = BodyType::factory()->create();

        $parameters = [
            'search' => $bodyType->name
        ];

        $this->call('GET','/api/body-types', $parameters)
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


}
