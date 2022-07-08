<?php

namespace App\Http\Controllers\Api\Admin;

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
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return ColorResource::collection($colors);
    }

    public function store(ColorRequestStore $request)
    {
        $color = Color::create($request->only(['name', 'hex']));

        return new ColorResource($color);
    }
    
    public function update(ColorRequestUpdate $request,  Color $color)
    {
        $color->update($request->only(['name', 'hex']));

        return new ColorResource($color);
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return response([],204);
    }
}
