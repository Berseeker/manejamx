<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VehicleInspectionRequestStore;
use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;


class VehicleInspectionController extends Controller
{

    public function store(VehicleInspectionRequestStore $request, Vehicle $vehicle)
    {
        $vehicle->inspections()->sync($request->inspections);
        
        return new VehicleResource($vehicle);
    }
}
