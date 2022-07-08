<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VehicleAccessoryRequestStore;
use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;


class VehicleAccessoryController extends Controller
{

    public function store(VehicleAccessoryRequestStore $request, Vehicle $vehicle)
    {

        $vehicle->accessories()->sync($request->accessories);
        
        return new VehicleResource($vehicle);
    }
}
