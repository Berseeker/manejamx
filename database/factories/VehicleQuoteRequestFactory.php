<?php

namespace Database\Factories;

use App\Models\BodyType;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Vehicle;
use App\Models\VehicleQuoteRequest;
use App\Models\Version;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleQuoteRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleQuoteRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        

        return [
            'vehicle_id'   => Vehicle::factory()->create()->id,
            'name'         => $this->faker->name,
            'last_name'    => $this->faker->lastName,
            'email'        => $this->faker->email,
            'phone'        => $this->faker->phoneNumber,
            'description'  => $this->faker->word,
            'observations' => $this->faker->word,
            'date'         => Carbon ::now()->format('Y-m-d'),
            'time'         => Carbon ::now()->format('H:i'),
        ];
    }
}
