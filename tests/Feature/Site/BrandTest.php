<?php

namespace Tests\Feature\Site;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_brands()
    {
        $brand = Brand::factory()->create();

        $this->getJson('/api/brands')
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
        $brand     = Brand::factory()->create();
        $otherMake = Brand::factory()->create();

        $parameters = [
            'search' => $brand->name
        ];

        $this->call('GET','/api/brands', $parameters)
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


}
