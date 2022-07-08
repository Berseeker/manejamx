<?php

namespace App\Http\Controllers\Api;

use App\Models\AccessoryType;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccessoryTypeResource;

class AccessoryTypeController extends Controller
{
    public function index()
    {
        $accessoryTypes = AccessoryType::query()
            ->search()
            ->with(['accessories'])
            ->orderByDesc('created_at')
            ->paginateIf();

        return AccessoryTypeResource::collection($accessoryTypes);
    }

}
