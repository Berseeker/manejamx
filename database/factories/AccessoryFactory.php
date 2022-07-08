<?php

namespace Database\Factories;

use App\Models\Accessory;
use App\Models\AccessoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accessory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'    => $this->faker->word,
            'type_id' => AccessoryType::factory()->create()->id
        ];
    }
}
