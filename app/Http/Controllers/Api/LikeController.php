<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\VehicleResource;
use App\Models\Vehicle;

class LikeController extends Controller
{
    public function update(Vehicle $vehicle)
    {
        $vehicle->toggleLike();

        return New VehicleResource($vehicle->load([
            'cylinders', 'transmissions', 'accessories', 'brand', 'model', 'version', 'fuels', 'colors',
            'interior_colors', 'body_type'
        ]));
    }
}
