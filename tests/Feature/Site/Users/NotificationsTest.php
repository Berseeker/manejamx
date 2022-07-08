<?php

namespace Tests\Feature\Site\Users;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_toggle_notifications()
    {
        $user = User::factory()->client()->create();

        $this->actingAs($user, 'api');

        $this->assertDatabaseHas('users', [
            'id'            => $user->id,
            'notifications' => false
        ]);

        $this->assertDatabaseMissing('users', [
            'id'            => $user->id,
            'notifications' => true
        ]);

        $this->putJson('/api/site/users/' . $user->id . '/toggle-notifications')
            ->assertStatus(200);

        $this->assertDatabaseMissing('users', [
            'id'            => $user->id,
            'notifications' => false
        ]);

        $this->assertDatabaseHas('users', [
            'id'            => $user->id,
            'notifications' => true
        ]);
    }
}
