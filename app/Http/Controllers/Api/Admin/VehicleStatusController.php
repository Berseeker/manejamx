<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\VehicleStatusResource;
use App\Http\Controllers\Controller;
use App\Models\VehicleStatus;

class VehicleStatusController extends Controller
{

    public function index()
    {

        $status = VehicleStatus::get();
        
        return  VehicleStatusResource::collection($status);
    }
}
