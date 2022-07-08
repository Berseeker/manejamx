<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleChangeStatusRequest;
use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;

class VehicleChangeStatusController extends Controller
{



    public function update(VehicleChangeStatusRequest $request, Vehicle $vehicle)
    {
        $vehicle->status_id = $request->status_id;

        if($request->status_id == VehicleStatus::SOLD){
            $vehicle->active = false;
        }

        $vehicle->save();

        if($request->status_id == VehicleStatus::SOLD && $vehicle->affiliate) {
            $vehicle->affiliate->update(['points'   => $vehicle->sell_price/10000]);
        }

        return new VehicleResource($vehicle);
    }
}
