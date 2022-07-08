<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\AccessoryType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccessoryTypeRequestStore;
use App\Http\Requests\Admin\AccessoryTypeRequestUpdate;
use App\Http\Resources\AccessoryTypeResource;

class AccessoryTypeController extends Controller
{
    public function index()
    {
        $accessoryTypes = AccessoryType::query()
            ->withTrash() 
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return AccessoryTypeResource::collection($accessoryTypes);
    }

    public function store(AccessoryTypeRequestStore $request)
    {
        $accessoryType = AccessoryType::create($request->only(['name']));

        return new AccessoryTypeResource($accessoryType);
    }
    
    public function update(AccessoryTypeRequestUpdate $request,  AccessoryType $accessoryType)
    {
        $accessoryType->update($request->only(['name']));

        return new AccessoryTypeResource($accessoryType);
    }

    public function destroy(AccessoryType $accessoryType)
    {
        $accessoryType->delete();

        return response([],204);
    }
}
