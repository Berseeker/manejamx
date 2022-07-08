<?php

namespace App\Http\Controllers\Api;

use App\Models\Fuel;
use App\Http\Controllers\Controller;
use App\Http\Resources\FuelResource;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return FuelResource::collection($fuels);
    }

}
