<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function show($slug)
    {
        $data = explode('-', $slug);

        $vehicle = Vehicle::query()->find(end($data));

        return view('site.cars.show', compact('vehicle'));
    }
}
