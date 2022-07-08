<?php

namespace Database\Factories;

use App\Models\AffiliateVehicleColor;
use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliateVehicleColorFactory extends Factory
{
    protected $model = AffiliateVehicleColor::class;

    public function definition(): array
    {
        return [
            'color_id'  => Color::factory()->create()->id,
        ];
    }
}
