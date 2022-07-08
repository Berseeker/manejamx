<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExternalVehicle;
use Illuminate\Http\Request;

class ExternalVehicleController extends Controller
{
    public function index(Request $request)
    {
        return ExternalVehicle::avg()
            ->paginate(16);
    }
}
