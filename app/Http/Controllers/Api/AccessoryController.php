<?php

namespace App\Http\Controllers\Api;

use App\Models\Accessory;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccessoryResource;

class AccessoryController extends Controller
{
    public function index()
    {
        $accessories = Accessory::query()
            ->search()
            ->type()
            ->orderByDesc('created_at')
            ->paginateIf();

        return AccessoryResource::collection($accessories);
    }

}
