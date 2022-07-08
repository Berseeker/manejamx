<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\AffiliateVehicle;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Status;
use App\Models\User;
use App\Models\Version;
use Illuminate\Database\Eloquent\Factories\Factory;

class AffiliateVehicleFactory extends Factory
{
    protected $model = AffiliateVehicle::class;

    public function definition(): array
    {
        return [
            'brand_id'      => Brand::factory()->create()->id,
            'model_id'      => Model::factory()->create()->id,
            'version_id'    => Version::factory()->create()->id,
            'year'          => $this->faker->year,
            'odometer'      => $this->faker->numberBetween(1, 100),
            'sell_price'    => $this->faker->numberBetween(1, 100),
            'user_id'       => User::factory()->create()->id,
            'affiliate_id'  => Affiliate::factory()->create()->id,
            'status_id'     => Status::factory()->create()->id,
        ];
    }
}
