<?php

namespace App\Http\Controllers\Api;

use App\Models\Drive;
use App\Http\Controllers\Controller;
use App\Http\Resources\DriveResource;

class DriveController extends Controller
{
    public function index()
    {
        $drives = Drive::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return DriveResource::collection($drives);
    }

}
