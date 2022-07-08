<?php

namespace Tests\Feature\Site;

use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_toggle_likes()
    {
        $user = $this->signIn();

        $vehicle = Vehicle::factory()->create();

        $this->assertDatabaseMissing('likes', [
            'user_id'       => $user->id,
            'vehicle_id'    => $vehicle->id
        ]);

        $this->putJson('/api/vehicles/'.$vehicle->id.'/likes')
            ->assertStatus(200);

        $this->assertDatabaseHas('likes', [
            'user_id'       => $user->id,
            'vehicle_id'    => $vehicle->id
        ]);

        $this->putJson('/api/vehicles/'.$vehicle->id.'/likes')
            ->assertStatus(200);

        $this->assertDatabaseMissing('likes', [
            'user_id'       => $user->id,
            'vehicle_id'    => $vehicle->id
        ]);
    }
}
