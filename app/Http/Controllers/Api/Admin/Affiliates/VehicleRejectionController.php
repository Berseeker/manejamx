<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateVehicleResource;
use App\Models\AffiliateVehicle;
use App\Models\Status;
use Illuminate\Http\Request;

class VehicleRejectionController extends Controller
{
    public function store($vehicleId): AffiliateVehicleResource
    {
        $vehicle = AffiliateVehicle::query()->find($vehicleId);

        $vehicle->update([
            'status_id'     => Status::REJECTED,
            'rejected_by'   => auth('api')->id(),
            'rejected_at'   => now()->format('Y-m-d H:i'),
        ]);

        return new AffiliateVehicleResource($vehicle);
    }
}
