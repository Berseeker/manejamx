<?php

namespace App\Http\Controllers\Api\Admin\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Resources\AffiliateVehicleResource;
use App\Models\AffiliateVehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleController extends Controller
{
    public function index(): JsonResource
    {
        $vehicles = AffiliateVehicle::query()
            ->with(['brand', 'model', 'version', 'status', 'user', 'interior_colors', 'exterior_colors', 'files'])
            ->paginateIf();

        return AffiliateVehicleResource::collection($vehicles);
    }
}
