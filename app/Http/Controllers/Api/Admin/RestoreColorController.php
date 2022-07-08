<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use App\Models\Color;

class RestoreColorController extends Controller
{
    
    public function update($color_id)
    {
        $color = Color::withTrashed()->find($color_id);
        $color->restore();

        return new ColorResource($color);
    }

}
