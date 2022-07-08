<?php

namespace App\Http\Controllers\Api;

use App\Models\BodyType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BodyTypeRequestStore;
use App\Http\Requests\Admin\BodyTypeRequestUpdate;
use App\Http\Resources\BodyTypeResource;

class BodyTypeController extends Controller
{
    public function index()
    {
        $bodyTypes = BodyType::query()
            ->search()
            ->orderByDesc('created_at')
            ->with(['file'])
            ->paginateIf();

        return BodyTypeResource::collection($bodyTypes);
    }

}
