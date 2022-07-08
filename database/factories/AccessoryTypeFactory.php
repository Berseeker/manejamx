<?php

namespace Database\Factories;

use App\Models\AccessoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AccessoryType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word
        ];
    }
}
