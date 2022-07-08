<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\VehicleQuoteRequestResource;
use App\Models\VehicleQuoteRequest;
use Illuminate\Http\Request;

class VehicleQuoteRequestController extends Controller
{
    public function index()
    {
        $quotes = VehicleQuoteRequest::query()
            ->with(['vehicle.brand', 'vehicle.model', 'vehicle.version'])
            ->search()
            ->orderByDesc('created_at')
            ->paginate();

        return VehicleQuoteRequestResource::collection($quotes);
    }
    
    public function update(Request $request, VehicleQuoteRequest $quoteRequest)
    {

        $quoteRequest->update($request->only([
            'answered',
            'observations'
        ]));

        return new VehicleQuoteRequestResource($quoteRequest);
    }
}
