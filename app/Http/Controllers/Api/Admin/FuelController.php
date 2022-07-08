<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Fuel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FuelRequestStore;
use App\Http\Requests\Admin\FuelRequestUpdate;
use App\Http\Resources\FuelResource;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return FuelResource::collection($fuels);
    }

    public function store(FuelRequestStore $request)
    {
        $fuel = Fuel::create($request->only(['name']));

        return new FuelResource($fuel);
    }
    
    public function update(FuelRequestUpdate $request,  Fuel $fuel)
    {
        $fuel->update($request->only(['name']));

        return new FuelResource($fuel);
    }

    public function destroy(Fuel $fuel)
    {
        $fuel->delete();

        return response([],204);
    }
}
