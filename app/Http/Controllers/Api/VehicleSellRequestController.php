<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VehicleSellRequestStore;
use App\Http\Resources\Site\VehicleSellRequestResource;
use App\Models\VehicleSellRequest;
use Illuminate\Http\Request;

class VehicleSellRequestController extends Controller
{
    public function store(VehicleSellRequestStore $request)
    {

        $sellRequest = VehicleSellRequest::create($request->only([
            'name',
            'last_name',
            'phone',
            'email',
            'brand_id',
            'model_id',
            'version_id',
            'year',
            'odometer',
            'sell_price',
        ]));

        $sellRequest->setUser();
        $sellRequest->addImage();
        $sellRequest->colors()->sync($request->colors);
        $sellRequest->interior_colors()->sync($request->interior_colors);
        $sellRequest->sendAdminMail();

        return new VehicleSellRequestResource($sellRequest);
    }
}
