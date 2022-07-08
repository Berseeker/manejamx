<?php

namespace App\Http\Controllers\Api;

use App\Models\Cylinder;
use App\Http\Controllers\Controller;
use App\Http\Resources\CylinderResource;

class CylinderController extends Controller
{
    public function index()
    {
        $transmissions = Cylinder::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return CylinderResource::collection($transmissions);
    }

}
