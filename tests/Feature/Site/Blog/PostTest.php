<?php

namespace Tests\Feature\Site\Blog;

use App\Models\Blog\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    function test_lists_posts()
    {
        $post = Post::factory()->create();

        $this->get('api/blog/posts')
            ->assertStatus(200)
            ->assertJsonFragment([
                'title' => $post->title
            ]);
    }

    function test_show_a_post()
    {
        $post = Post::factory()->create();

        $this->get('api/blog/posts/'.$post->id)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $post->id,
                ]
            ]);
    }

}
