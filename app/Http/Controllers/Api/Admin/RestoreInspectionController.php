<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\InspectionResource;
use App\Models\Inspection;

class RestoreInspectionController extends Controller
{
    
    public function update($inspection_id)
    {
        $inspection = Inspection::withTrashed()->find($inspection_id);
        $inspection->restore();

        return new InspectionResource($inspection);
    }

}
