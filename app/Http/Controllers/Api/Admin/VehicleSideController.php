<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\VehicleSide;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleSideRequestStore;
use App\Http\Requests\Admin\VehicleSideRequestUpdate;
use App\Http\Resources\VehicleSideResource;

class VehicleSideController extends Controller
{
    public function index()
    {
        $vehicleSides = VehicleSide::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return VehicleSideResource::collection($vehicleSides);
    }

    public function store(VehicleSideRequestStore $request)
    {
        $vehicleSide = VehicleSide::create($request->only(['name']));

        return new VehicleSideResource($vehicleSide);
    }
    
    public function update(VehicleSideRequestUpdate $request,  VehicleSide $vehicleSide)
    {
        $vehicleSide->update($request->only(['name']));

        return new VehicleSideResource($vehicleSide);
    }

    public function destroy(VehicleSide $vehicleSide)
    {
        $vehicleSide->delete();

        return response([],204);
    }
}
