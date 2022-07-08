<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CylinderResource;
use App\Models\Cylinder;

class RestoreCylinderController extends Controller
{
    
    public function update($cylinder_id)
    {
        $cylinder = Cylinder::withTrashed()->find($cylinder_id);
        $cylinder->restore();

        return new CylinderResource($cylinder);
    }

}
