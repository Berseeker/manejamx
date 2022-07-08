<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessoryTypeResource;
use App\Models\AccessoryType;

class RestoreAccessoryTypeController extends Controller
{
    
    public function update($type_id)
    {
        $type = AccessoryType::withTrashed()->find($type_id);
        $type->restore();

        return new AccessoryTypeResource($type);
    }

}
