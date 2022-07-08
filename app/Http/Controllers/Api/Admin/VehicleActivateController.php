<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VehicleRequestStore;
use App\Http\Requests\Admin\VehicleRequestUpdate;
use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyOnVehicleActivation;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleActivateController extends Controller
{
    


    public function update(Vehicle $vehicle)
    {
        $vehicle->active = !$vehicle->active;
        $vehicle->save();

        if ($vehicle->active) {
            NotifyOnVehicleActivation::dispatch($vehicle);
        }

        return new VehicleResource($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response([],204);
    }
}
