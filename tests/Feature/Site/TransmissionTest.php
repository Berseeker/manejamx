<?php

namespace Tests\Feature\Site;

use App\Models\Transmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_transmissions()
    {
        $this->signIn();

        $transmission = Transmission::factory()->create();

        $this->getJson('/api/transmissions')
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
