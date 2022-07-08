<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Site\VehicleResource;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $min_price = Vehicle::select('sell_price')->orderBy('sell_price')->first()->sell_price;
        $max_price = Vehicle::select('sell_price')->orderByDesc('sell_price')->first()->sell_price;

        $min_year = Vehicle::select('year')->orderBy('year')->first()->year;
        $max_year = Vehicle::select('year')->orderByDesc('year')->first()->year;

        $min_odometer = Vehicle::select('odometer')->where('odometer', '>=', 0)->orderBy('odometer')->first()->odometer;
        $max_odometer = Vehicle::select('odometer')->where('odometer', '>=', 0)->orderByDesc('odometer')->first()->odometer;

        $vehicles =  Vehicle::query()
            ->where('active', true)
            ->search()
            ->brandId()
            ->affiliate()
            ->priceRange()
            ->yearRange()
            ->odometerRange()
            ->bodyTypeIn()
            ->accessories()
            ->fuelIn()
            ->modelIn()
            ->cylinderIn()
            ->colorIn()
            ->transmissionIn()
            ->driveIn()
            ->likedByUser()
            ->viewedByUser()
            ->ordered()
            ->with([
                'cylinders', 'transmissions', 'accessories', 'brand', 'model', 'version', 'fuels', 'colors', 'interior_colors', 'body_type', 'status'
            ])
            ->paginateIf();


        return VehicleResource::collection($vehicles)
                                ->additional([
                                    'price_ranges'    => [$min_price, $max_price],
                                    'year_ranges'     => [$min_year, $max_year],
                                    'odometer_ranges' => [$min_odometer, $max_odometer],
                                ]);
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load([
            'cylinders', 'transmissions', 'accessories.type', 'brand', 'model', 'version', 'fuels', 'colors',
            'interior_colors', 'body_type', 'inspections', 'status'
        ])->loadCount(['likes', 'views']);

        return new VehicleResource($vehicle,);
    }

}
