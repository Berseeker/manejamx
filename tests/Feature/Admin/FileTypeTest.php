<?php

namespace Tests\Feature\Admin;

use App\Models\FileType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FileTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_file_types()
    {
        $this->signIn();

        $type = FileType::factory()->create();

        $this->getJson('/api/admin/file-types')
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    0 => [
                        'id' => $type->id
                    ]
                ]
            ]);
    }

    


}
