<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\FuelResource;
use App\Models\Fuel;

class RestoreFuelController extends Controller
{
    
    public function update($fuel_id)
    {
        $fuel = Fuel::withTrashed()->find($fuel_id);
        $fuel->restore();

        return new FuelResource($fuel);
    }

}
