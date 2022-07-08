<?php

namespace Database\Factories;

use App\Models\FileType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FileTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FileType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word
        ];
    }
}
