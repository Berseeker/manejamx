<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Version::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'model_id'  => Model::factory()->create()->id,
            'name'      => $this->faker->unique()->word,
            'year'      => rand(2000, 2020),
            'sell'      => rand(50000, 100000),
            'buy'       => rand(50000, 100000),
            'currency'  => 'MXN'
        ];
    }
}
