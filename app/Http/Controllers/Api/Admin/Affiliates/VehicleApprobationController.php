<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateVehicleResource;
use App\Models\AffiliateVehicle;
use App\Models\Status;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;

class VehicleApprobationController extends Controller
{
    public function store($vehicleId): AffiliateVehicleResource
    {
        $affiliateVehicle = AffiliateVehicle::query()->with(['interior_colors', 'exterior_colors', 'files'])->find($vehicleId);

        $affiliateVehicle->update([
            'status_id'     => Status::APPROVED,
            'approved_by'   => auth('api')->id(),
            'approved_at'   => now()->format('Y-m-d H:i'),
        ]);

        $data = $affiliateVehicle->only([
            'brand_id', 'model_id', 'version_id', 'year' , 'odometer', 'sell_price', 'affiliate_id', 'user_id', 'active'
        ]);

        $data['active'] = false;
        $data['status_id'] = VehicleStatus::AVAILABLE;

        $vehicle = Vehicle::query()->create($data);

        $vehicle->colors()->attach($affiliateVehicle->exterior_colors->pluck('id'));
        $vehicle->interior_colors()->attach($affiliateVehicle->interior_colors->pluck('id'));

        foreach ($affiliateVehicle->files as $file) {
            $vehicle->images()->create($file->only(['path', 'filename', 'name']));
        }

        return new AffiliateVehicleResource($affiliateVehicle);
    }
}
