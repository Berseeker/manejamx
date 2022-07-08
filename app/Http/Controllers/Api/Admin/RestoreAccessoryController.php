<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessoryResource;
use App\Models\Accessory;

class RestoreAccessoryController extends Controller
{
    
    public function update($accessory_id)
    {
        $accessory = Accessory::withTrashed()->find($accessory_id);
        $accessory->restore();

        return new AccessoryResource($accessory);
    }

}
