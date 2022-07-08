<?php

namespace Tests\Feature\Site;

use App\Models\AccessoryType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessoryTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_accessory_types()
    {

        $type = AccessoryType::factory()->create();

        $this->getJson('/api/accessory-types')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $type->id
                    ]
                ]
            ]);
    }
    

    public function test_search_accessory_types_by_name()
    {

        $type       = AccessoryType::factory()->create();
        $otherType  = AccessoryType::factory()->create();

        $parameters = [
            'search' => $type->name
        ];

        $this->call('GET','/api/accessory-types', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $type->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherType->id
                    ]
                ]
            ]);
    }


}
