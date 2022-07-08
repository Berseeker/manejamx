<?php

namespace App\Http\Controllers\Api\Site\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AffiliateVehicleStore;
use App\Http\Resources\AffiliateVehicleResource;
use App\Models\AffiliateVehicle;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleController extends Controller
{
    public function index(): JsonResource
    {
        $vehicles = AffiliateVehicle::query()
            ->with(['brand', 'model', 'version', 'status'])
            ->where('user_id', auth('api')->id())
            ->paginateIf();

        return AffiliateVehicleResource::collection($vehicles);
    }

    public function store(AffiliateVehicleStore $request): AffiliateVehicleResource
    {
        $request->merge([
            'affiliate_id'  => $request->user('api')->affiliate_id,
            'user_id'       => $request->user('api')->id,
            'status_id'     => Status::IN_PROCESS,
        ]);

        $vehicle = AffiliateVehicle::query()->create($request->only([
            'brand_id', 'model_id', 'version_id', 'year', 'odometer', 'sell_price', 'user_id', 'affiliate_id', 'status_id',
        ]));

        $vehicle->addColors($request->colors, $request->interior_colors);

        $vehicle->addFile($request->file('file'));

        return new AffiliateVehicleResource($vehicle);
    }
}
