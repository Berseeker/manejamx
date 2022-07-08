<?php

namespace Tests\Feature\Site;

use App\Models\Cylinder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CylinderTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_transmissions()
    {
        $this->signIn();

        $transmission = Cylinder::factory()->create();

        $this->getJson('/api/cylinders')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $transmission->id
                    ]
                ]
            ]);
    }

}
