<?php

namespace Tests\Feature\Site;

use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_a_view()
    {
        $user = $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->assertDatabaseMissing('views', [
            'user_id'       => $user->id,
            'vehicle_id'    => $vehicle->id
        ]);

        $this->postJson('/api/vehicles/'.$vehicle->id.'/views')
            ->assertStatus(200);

        $this->assertDatabaseHas('views', [
            'user_id'       => $user->id,
            'vehicle_id'    => $vehicle->id
        ]);
    }
}
