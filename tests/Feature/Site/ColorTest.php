<?php

namespace Tests\Feature\Site;

use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_color()
    {
        $this->signIn();

        $color = Color::factory()->create();

        $this->getJson('/api/admin/colors')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $color->id
                    ]
                ]
            ]);
    }

    public function test_search_color_by_name()
    {
        $this->signIn();

        $color     = Color::factory()->create();
        $otherColor = Color::factory()->create();

        $parameters = [
            'search' => $color->name
        ];

        $this->call('GET','/api/admin/colors', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $color->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherColor->id
                    ]
                ]
            ]);
    }

}
