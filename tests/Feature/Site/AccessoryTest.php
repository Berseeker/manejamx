<?php

namespace Tests\Feature\Site;

use App\Models\Accessory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccessoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_accessories()
    {
        $this->signIn();

        $accessory = Accessory::factory()->create();

        $this->getJson('/api/accessories')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $accessory->id
                    ]
                ]
            ]);
    }
    
    public function test_search_accessory_by_name()
    {
        $this->signIn();

        $accessory  = Accessory::factory()->create();
        $otherType  = Accessory::factory()->create();

        $parameters = [
            'search' => $accessory->name
        ];

        $this->call('GET','/api/accessories', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $accessory->id
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
