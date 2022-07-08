<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\VehicleSellRequestUpdate;
use App\Http\Resources\Admin\VehicleSellRequestResource;
use App\Models\VehicleSellRequest;

class VehicleSellRequestController extends Controller
{

    public function index()
    {

        $sellRequests = VehicleSellRequest::query()
            ->search()
            ->with([
                'brand',
                'model',
                'version',
                'images'
            ])
            ->orderByDesc('created_at')
            ->paginate();

        return VehicleSellRequestResource::collection($sellRequests);
    }


    public function update(VehicleSellRequestUpdate $request,  VehicleSellRequest $sellRequest)
    {

        $sellRequest->update($request->only([
            'answered',
            'observations',
        ]));

        return new VehicleSellRequestResource($sellRequest);
    }
}
