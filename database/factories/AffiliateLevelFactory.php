<?php

namespace Database\Factories;

use App\Models\AffiliateLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliateLevelFactory extends Factory
{
    protected $model = AffiliateLevel::class;

    public function definition(): array
    {
        return [
            'name'          => $this->faker->word,
            'start_points'  => $this->faker->numberBetween(1, 5),
            'end_points'    => $this->faker->numberBetween(6, 10)
        ];
    }
}
