<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand_id'  => Brand::factory()->create()->id,
            'name'      => $this->faker->unique()->word
        ];
    }
}
