<?php

namespace Tests\Feature\Admin\Blog;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    function test_list_posts()
    {
        $this->signIn();

        $post = Post::factory()->create();

        $this->get('api/admin/blog/posts')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0 => [
                        'id'            => $post->id,
                        'categories'    => [],
                        'author'        => []
                    ]
                ]
            ]);
    }

    function test_show_a_post()
    {
        $this->signIn();

        $post = Post::factory()->create();

        $this->get('api/admin/blog/posts/'.$post->id)
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'            => $post->id,
                    'categories'    => []
                ]
            ]);
    }

    function test_store_a_post()
    {
        Storage::fake('public');

        $user = $this->signIn();

        $data = Post::factory()->make();
        $category = Category::factory()->create();

        $parameters = [
            'title'         => $data->title,
            'content'       => $data->content,
            'categories'    => [$category->id],
            'file'          => UploadedFile::fake()->image('test.png')
        ];

        $this->post('api/admin/blog/posts', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data'  => [
                    'title' => $data->title
                ]
            ]);

        $this->assertDatabaseHas('blog_posts', [
            'title'         => $data->title,
            'content'       => $data->content,
            'author_id'     => $user->id
        ]);

        $this->assertDatabaseHas('blog_post_category', [
            'post_id'       => Post::max('id'),
            'category_id'   => $category->id
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_type' => Post::class,
            'fileable_id'   => Post::max('id'),
            'name'          => 'test.png'
        ]);
    }

    function test_validate_post_at_store()
    {
        $this->signIn();

        $this->postJson('api/admin/blog/posts', [])
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'title'         => ['El campo título es obligatorio.'],
                    'content'       => ['El campo contenido es obligatorio.'],
                    'categories'    => ['El campo categorías es obligatorio.'],
                    'file'          => ['El campo imagen es obligatorio.']
                ]
            ]);
    }

    function test_update_a_post()
    {
        Storage::fake('public');

        $user = $this->signIn();

        $post = Post::factory()->create();
        $data = Post::factory()->make();
        $category = Category::factory()->create();

        $parameters = [
            'title'         => $data->title,
            'content'       => $data->content,
            'categories'    => [$category->id],
            'file'          => UploadedFile::fake()->image('test.png')
        ];

        $this->put('api/admin/blog/posts/'.$post->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id' => $post->id
                ]
            ]);

        $this->assertDatabaseHas('blog_posts', [
            'id'            => $post->id,
            'title'         => $data->title,
            'content'       => $data->content,
            'author_id'     => $user->id
        ]);

        $this->assertDatabaseHas('blog_post_category', [
            'post_id'       => $post->id,
            'category_id'   => $category->id
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_type' => Post::class,
            'fileable_id'   => $post->id,
            'name'          => 'test.png'
        ]);
    }

    function test_validate_post_at_update()
    {
        $this->signIn();

        $post = Post::factory()->create();

        $this->putJson('api/admin/blog/posts/'.$post->id, [])
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'title'         => ['El campo título es obligatorio.'],
                    'content'       => ['El campo contenido es obligatorio.'],
                    'categories'    => ['El campo categorías es obligatorio.']
                ]
            ]);
    }

    function test_destroy_a_post()
    {
        $this->signIn();

        $post = Post::factory()->create();

        $this->delete('api/admin/blog/posts/'.$post->id)->assertStatus(204);

        $this->assertSoftDeleted('blog_posts', [
            'id'    => $post->id,
        ]);
    }
}
