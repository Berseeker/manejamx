<?php

namespace Tests\Feature\Admin\Affiliate;

use App\Models\AffiliateVehicle;
use App\Models\Color;
use App\Models\File;
use App\Models\Status;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase;

    function test_list_affiliate_vehicles()
    {
        $this->signIn();

        $vehicle = AffiliateVehicle::factory()->create();

        $this->get('api/admin/affiliates/vehicles')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    0   => [
                        'id'        => $vehicle->id,
                        'brand'     => [],
                        'model'     => [],
                        'version'   => [],
                        'status'    => [],
                        'user'      => []
                    ]
                ]
            ]);
    }

    function test_approve_a_affiliate_vehicle()
    {
        $user = $this->signIn();

        $status = Status::factory()->create(['id' => Status::APPROVED]);
        $vehicle = AffiliateVehicle::factory()->create();

        $color = Color::factory()->create();

        DB::table('affiliate_vehicle_colors')->insert([
            'color_id'      => $color->id,
            'vehicle_id'    => $vehicle->id,
            'interior'      => false,
            'exterior'      => true,
        ]);

        $interiorColor = Color::factory()->create();

        DB::table('affiliate_vehicle_colors')->insert([
            'color_id'      => $interiorColor->id,
            'vehicle_id'    => $vehicle->id,
            'interior'      => true,
            'exterior'      => false,
        ]);

        $file = File::factory()->create([
            'fileable_id'   => $vehicle->id,
            'fileable_type' => AffiliateVehicle::class
        ]);

        $vehicleStatus = VehicleStatus::factory()->create(['id' => VehicleStatus::AVAILABLE]);

        $this->post('api/admin/affiliates/vehicles/'.$vehicle->id.'/approbations')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'    => $vehicle->id,
                ]
            ]);

        $this->assertDatabaseHas('affiliate_vehicles', [
            'id'            => $vehicle->id,
            'approved_at'   => now()->format('Y-m-d H:i'),
            'approved_by'   => $user->id,
            'status_id'     => $status->id,
        ]);

        $this->assertDatabaseHas('vehicles', [
            'brand_id'      => $vehicle->brand_id,
            'model_id'      => $vehicle->model_id,
            'version_id'    => $vehicle->version_id,
            'year'          => $vehicle->year,
            'odometer'      => $vehicle->odometer,
            'sell_price'    => $vehicle->sell_price,
            'user_id'       => $vehicle->user_id,
            'affiliate_id'  => $vehicle->affiliate_id,
            'status_id'     => $vehicleStatus->id,
            'active'        => false,
        ]);

        $this->assertDatabaseHas('color_vehicle', [
            'vehicle_id'    => Vehicle::query()->max('id'),
            'color_id'      => $color->id,
        ]);

        $this->assertDatabaseHas('interior_color_vehicle', [
            'vehicle_id'    => Vehicle::query()->max('id'),
            'color_id'      => $interiorColor->id,
        ]);

        $this->assertDatabaseHas('files', [
            'fileable_id'   => Vehicle::query()->max('id'),
            'fileable_type' => Vehicle::class,
            'name'          => $file->name,
            'filename'      => $file->filename,
        ]);
    }

    function test_reject_a_affiliate_vehicle()
    {
        $user = $this->signIn();

        $vehicle = AffiliateVehicle::factory()->create();
        $status = Status::factory()->create(['id' => Status::REJECTED]);

        $this->post('api/admin/affiliates/vehicles/'.$vehicle->id.'/rejections')
            ->assertStatus(200)
            ->assertJson([
                'data'  => [
                    'id'    => $vehicle->id,
                ]
            ]);

        $this->assertDatabaseHas('affiliate_vehicles', [
            'id'            => $vehicle->id,
            'rejected_at'   => now()->format('Y-m-d H:i'),
            'rejected_by'   => $user->id,
            'status_id'     => $status->id,
        ]);
    }
}
