<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Model;
use App\Models\User;
use App\Models\VehicleSellRequest;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleSellRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleSellRequest::class;

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
            'name'       => $this->faker->name,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->email,
            'phone'      => $this->faker->phoneNumber,
            'sell_price' => $this->faker->randomDigitNotNull,
            'year'       => $this->faker->year,
            'odometer'   => $this->faker->randomDigitNotNull,
            'brand_id'   => $brand->id,
            'model_id'   => $model->id,
            'version_id' => Version::factory()->create(['model_id' => $model->id]),
            'user_id'    => User::factory()->create(),
            'answered'   => $this->faker->boolean,
            'observations'   => $this->faker->word,
        ];
    }
}
