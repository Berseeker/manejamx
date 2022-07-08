<?php

namespace Tests\Feature\Admin;

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

        $color      = Color::factory()->create();
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

    public function test_store_a_color()
    {
        $this->signIn();

        $data = Color::factory()->make();

        $parameters = [
            'name' => $data->name,
            'hex'  => $data->hex,
        ];

        $this->postJson('api/admin/colors/', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'name' => $data->name,
                    'hex'  => $data->hex,
                ]
            ]);

        $this->assertDatabaseHas('colors', [
            'name' => $data->name,
            'hex'  => $data->hex,
        ]);

    }

    public function test_validate_store_a_color()
    {
        $this->signIn();

        $data       = Color::factory()->make();
        $parameters = [];

        $this->postJson('api/admin/colors/', $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                    'hex'  => ['El campo hex es obligatorio.'],
                ]
            ]);

    }
    
    public function test_update_a_color()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $color = Color::factory()->create();
        $data  = Color::factory()->make();

        $parameters = [
            'name' => $data->name,
            'hex'  => $data->hex,
        ];

        $this->putJson('api/admin/colors/'.$color->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id'   => $color->id,
                    'name' => $data->name,
                    'hex'  => $data->hex,
                ]
            ]);

        $this->assertDatabaseHas('colors', [
            'id'   => $color->id,
            'name' => $data->name,
            'hex'  => $data->hex,
        ]);

    }

    public function test_validate_update_a_color()
    {

        $this->signIn();

        $color       = Color::factory()->create();
        $parameters = [];

        $this->putJson('api/admin/colors/'.$color->id, $parameters)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['El campo nombre es obligatorio.'],
                    'hex'  => ['El campo hex es obligatorio.'],
                ]
            ]);

    }
    
    public function test_destroy_a_color()
    {

        $this->signIn();

        $color = Color::factory()->create();

        $this->deleteJson('api/admin/colors/'.$color->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('colors', [
            'id' => $color->id
        ]);

    }
    
    public function test_restore_a_color()
    {

        $this->signIn();

        $color = Color::factory()->create();
        $color->delete();

        $this->putJson('api/admin/colors/'.$color->id.'/restorations')
            ->assertStatus(200);

        $this->assertDatabaseHas('colors', [
            'id' => $color->id
        ]);

    }


}
