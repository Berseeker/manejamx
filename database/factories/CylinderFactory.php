<?php

namespace Database\Factories;

use App\Models\Cylinder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CylinderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cylinder::class;

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
