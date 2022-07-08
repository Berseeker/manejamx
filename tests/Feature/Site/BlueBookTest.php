<?php

namespace Tests\Feature\Site;

use App\Models\Brand;
use App\Models\Model;
use App\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlueBookTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_price_version()
    {
        $this->signIn();

        $this->getJson('/api/blue-book/versions/100', )
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'sell'     => '',
                    'buy'      => '',
                    'currency' => '',
                ]
            ]);
    }

}
