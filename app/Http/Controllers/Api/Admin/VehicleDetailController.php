<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VehicleDetailRequestStore;
use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;


class VehicleDetailController extends Controller
{

    public function store(VehicleDetailRequestStore $request, Vehicle $vehicle)
    {

        $vehicle->transmissions()->sync($request->transmissions);
        $vehicle->cylinders()->sync($request->cylinders);
        $vehicle->fuels()->sync($request->fuels);
        $vehicle->colors()->sync($request->colors);
        $vehicle->interior_colors()->sync($request->interior_colors);
        $vehicle->drives()->sync($request->drives);

        return new VehicleResource($vehicle);
    }
}
