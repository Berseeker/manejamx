<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleSide;
use App\Http\Controllers\Controller;
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

}
