<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VehicleRequestStore;
use App\Http\Requests\Admin\VehicleRequestUpdate;
use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $vehicles =  Vehicle::query()
            ->statusId()
            ->brandId()
            ->modelId()
            ->fuelId()
            ->transmissionId()
            ->cylinderId()
            ->with([
                'cylinders', 'transmissions', 'accessories', 'brand', 'model', 'version', 'fuels', 'colors',
                'interior_colors', 'body_type', 'drives', 'inspections', 'status', 'affiliate'
            ])
            ->paginateIf();


        return VehicleResource::collection($vehicles);
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load([
            'cylinders', 'transmissions', 'accessories', 'brand', 'model', 'version', 'fuels', 'colors', 'interior_colors', 'body_type', 'drives', 'inspections'
        ]);

        return new VehicleResource($vehicle);
    }

    public function store(VehicleRequestStore $request)
    {
        $vehicle = Vehicle::create($request->only([
            'brand_id', 'model_id', 'version_id', 'year', 'sell_price', 'buy_price', 'body_type_id',
            'vin', 'doors', 'keys', 'fuel_consumption', 'odometer', 'description',
        ]));

        return new VehicleResource($vehicle);
    }

    public function update(VehicleRequestUpdate $request, Vehicle $vehicle)
    {
        $vehicle->update($request->only([
            'brand_id', 'model_id', 'version_id', 'year', 'sell_price', 'buy_price', 'body_type_id',
            'vin', 'doors', 'keys', 'fuel_consumption', 'odometer', 'description',
        ]));

        return new VehicleResource($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return response([],204);
    }
}
