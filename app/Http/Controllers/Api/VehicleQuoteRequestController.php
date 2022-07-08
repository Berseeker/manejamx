<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VehicleQuoteRequestStore;
use App\Http\Resources\Site\VehicleQuoteRequestResource;
use App\Models\Vehicle;

class VehicleQuoteRequestController extends Controller
{
    public function store(VehicleQuoteRequestStore $request ,Vehicle $vehicle)
    {
        $quote = $vehicle->quote_requests()->create($request->only([
            'name',
            'last_name',
            'phone',
            'email' ,
            'description',
            'date',
            'time',
        ]));

        $quote->sendAdminMail();

        return new VehicleQuoteRequestResource($quote);
    }
}
