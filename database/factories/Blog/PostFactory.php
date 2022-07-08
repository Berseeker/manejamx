<?php

namespace Database\Factories\Blog;

use App\Models\Blog\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->word,
            'content'   => $this->faker->paragraph,
            'author_id' => User::factory()->create()->id
        ];
    }
}
