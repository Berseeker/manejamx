<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliateFactory extends Factory
{
    protected $model = Affiliate::class;

    public function definition(): array
    {
        return [
            'commercial_name'   => $this->faker->word,
            'business_name'     => $this->faker->word,
            'rfc'               => $this->faker->numberBetween(1, 100),
            'address'           => $this->faker->address,
            'name'              => $this->faker->word,
            'last_name'         => $this->faker->word,
            'email'             => $this->faker->email,
            'phone'             => $this->faker->phoneNumber,
            'password'          => $this->faker->numberBetween(100, 500),
            'status_id'         => Status::factory()->create()->id,
        ];
    }
}
