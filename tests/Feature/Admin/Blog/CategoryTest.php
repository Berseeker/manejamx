<?php

namespace Tests\Feature\Admin\Blog;

use App\Models\Blog\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    function test_list_categories()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $this->get('api/admin/blog/categories')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0 => [
                        'id'    => $category->id
                    ]
                ]
            ]);
    }

    function test_store_a_category()
    {

        $this->signIn();

        $data = Category::factory()->make();

        $parameters = [
            'name'  => $data->name
        ];

        $this->post('api/admin/blog/categories', $parameters)
            ->assertStatus(201)
            ->assertJson([
                'data'  => [
                    'name'  => $data->name
                ]
            ]);

        $this->assertDatabaseHas('blog_categories', [
            'name'  => $data->name
        ]);
    }

    function test_validate_category_at_store()
    {
        $this->signIn();

        $this->postJson('api/admin/blog/categories', [])
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'name'  => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    function test_update_a_blog_category()
    {
        $this->signIn();

        $category = Category::factory()->create();
        $data = Category::factory()->make();

        $parameters = [
            'name'  => $data->name
        ];

        $this->put('api/admin/blog/categories/'.$category->id, $parameters)
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'    => $category->id
                ]
            ]);

        $this->assertDatabaseHas('blog_categories', [
            'id'    => $category->id,
            'name'  => $data->name
        ]);
    }

    function test_validate_category_at_update()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $this->putJson('api/admin/blog/categories/'.$category->id, [])
            ->assertStatus(422)
            ->assertJson([
                'errors'  => [
                    'name'  => ['El campo nombre es obligatorio.']
                ]
            ]);
    }

    function test_destroy_a_blog_category()
    {
        $this->signIn();

        $category = Category::factory()->create();

        $this->delete('api/admin/blog/categories/'.$category->id)->assertStatus(204);

        $this->assertSoftDeleted('blog_categories', [
            'id'    => $category->id,
        ]);
    }
}
