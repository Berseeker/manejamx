<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\BodyTypeResource;
use App\Models\BodyType;

class RestoreBodyTypeController extends Controller
{
    
    public function update($body_type_id)
    {
        $bodyType = BodyType::withTrashed()->find($body_type_id);
        $bodyType->restore();

        return new BodyTypeResource($bodyType);
    }

}
