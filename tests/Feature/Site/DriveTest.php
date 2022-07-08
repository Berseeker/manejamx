<?php

namespace Tests\Feature\Site;

use App\Models\Drive;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DriveTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_drives()
    {

        $drives = Drive::factory()->create();

        $this->getJson('/api/drives')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $drives->id
                    ]
                ]
            ]);
    }
    

    public function test_search_drives_by_name()
    {

        $drives      = Drive::factory()->create();
        $otherDrive  = Drive::factory()->create();

        $parameters = [
            'search' => $drives->name
        ];

        $this->call('GET','/api/drives', $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $drives->id
                    ]
                ]
            ])
            ->assertJsonMissing([
                'data' => [
                    1 => [
                        'id' => $otherDrive->id
                    ]
                ]
            ]);
    }

}
