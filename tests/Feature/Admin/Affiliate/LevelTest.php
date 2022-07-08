<?php

namespace Tests\Feature\Admin\Affiliate;

use App\Models\AffiliateLevel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LevelTest extends TestCase
{
    use RefreshDatabase;

    function test_list_affiliate_levels()
    {
        $this->signIn();

        $level = AffiliateLevel::factory()->create();

        $this->get('api/admin/affiliates/levels')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0   => [
                        'id'    => $level->id,
                        'file'  => [],
                    ]
                ]
            ]);
    }

    function test_store_a_affiliate_level()
    {
        Storage::fake();

        $this->signIn();

        $data = AffiliateLevel::factory()->make();

        $parameters = [
            'name'          => $data->name,
            'start_points'  => $data->start_points,
            'end_points'    => $data->end_points,
            'file'          => UploadedFile::fake()->image('test.png')
        ];

        $this->post('api/admin/affiliates/levels', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data'  => [
                    'name'  => $data->name
                ]
            ]);

        $this->assertDatabaseHas('affiliate_levels', [
            'name'          => $data->name,
            'start_points'  => $data->start_points,
            'end_points'    => $data->end_points
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => AffiliateLevel::query()->max('id'),
            'fileable_type' => AffiliateLevel::class,
            'name'          => 'test.png',
        ]);
    }

    function test_validate_affiliate_level_at_store()
    {
        $this->signIn();

        $this->postJson('api/admin/affiliates/levels')
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'name'          => ['El campo nombre es obligatorio.'],
                    'start_points'  => ['El campo puntos desde es obligatorio.'],
                    'end_points'    => ['El campo puntos hasta es obligatorio.'],
                    'file'          => ['El campo insignia es obligatorio.'],
                ]
            ]);
    }

    function test_update_a_affiliate_level()
    {
        Storage::fake();

        $this->signIn();

        $level = AffiliateLevel::factory()->create();
        $data = AffiliateLevel::factory()->make();

        $parameters = [
            'name'          => $data->name,
            'start_points'  => $data->start_points,
            'end_points'    => $data->end_points,
            'file'          => UploadedFile::fake()->image('test.png')
        ];

        $this->put('api/admin/affiliates/levels/'.$level->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'  => $level->id
                ]
            ]);

        $this->assertDatabaseHas('affiliate_levels', [
            'id'            => $level->id,
            'name'          => $data->name,
            'start_points'  => $data->start_points,
            'end_points'    => $data->end_points
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => $level->id,
            'fileable_type' => AffiliateLevel::class,
            'name'          => 'test.png',
        ]);
    }

    function test_validate_affiliate_level_at_update()
    {
        $this->signIn();

        $level = AffiliateLevel::factory()->create();

        $this->putJson('api/admin/affiliates/levels/'.$level->id)
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'name'          => ['El campo nombre es obligatorio.'],
                    'start_points'  => ['El campo puntos desde es obligatorio.'],
                    'end_points'    => ['El campo puntos hasta es obligatorio.'],
                    'file'          => ['El campo insignia es obligatorio.'],
                ]
            ]);
    }

    function test_destroy_a_affiliate_level()
    {
        $this->signIn();

        $level = AffiliateLevel::factory()->create();

        $this->delete('api/admin/affiliates/levels/'.$level->id)
            ->assertStatus(204);

        $this->assertSoftDeleted('affiliate_levels', [
            'id'    => $level->id,
        ]);
    }
}
