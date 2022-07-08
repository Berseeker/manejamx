<?php

namespace App\Http\Controllers\Api;

use App\Models\Color;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorRequestStore;
use App\Http\Requests\Admin\ColorRequestUpdate;
use App\Http\Resources\ColorResource;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return ColorResource::collection($colors);
    }
}
