<?php

namespace Database\Factories;

use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brand = Brand::factory()->create();

        $model = Model::factory()->create(['brand_id' => $brand->id]);

        return [
            'brand_id'         => $brand->id,
            'model_id'         => $model->id,
            'year'             => $this->faker->year,
            'sell_price'       => $this->faker->randomDigitNotNull,
            'buy_price'        => $this->faker->randomDigitNotNull,
            'doors'            => $this->faker->randomDigitNotNull,
            'keys'             => $this->faker->randomDigitNotNull,
            'odometer'         => $this->faker->randomDigitNotNull,
            'vin'              => $this->faker->word,
            'fuel_consumption' => $this->faker->randomDigitNotNull,
            'version_id'       => Version ::factory()->create(['model_id' => $model->id]),
            'body_type_id'     => BodyType::factory()->create(),
            'status_id'        => VehicleStatus::factory()->create() 
        ];
    }
}
