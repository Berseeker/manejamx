<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Accessory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccessoryRequestStore;
use App\Http\Requests\Admin\AccessoryRequestUpdate;
use App\Http\Resources\AccessoryResource;

class AccessoryController extends Controller
{
    public function index()
    {
        $accessories = Accessory::query()
            ->withTrash()
            ->search()
            ->type()
            ->with(['type'])
            ->orderByDesc('created_at')
            ->paginateIf();

        return AccessoryResource::collection($accessories);
    }

    public function store(AccessoryRequestStore $request)
    {
        $accessory = Accessory::create($request->only(['name', 'type_id']));

        return new AccessoryResource($accessory);
    }
    
    public function update(AccessoryRequestUpdate $request,  Accessory $accessory)
    {
        $accessory->update($request->only(['name', 'type_id']));

        return new AccessoryResource($accessory);
    }

    public function destroy(Accessory $accessory)
    {
        $accessory->delete();

        return response([],204);
    }
}
