<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_clients()
    {
        $this->signIn();

        User::factory()->count(3)->client()->create();

        $this->getJson('/api/admin/clients')
            ->assertStatus(200);
    }
}
