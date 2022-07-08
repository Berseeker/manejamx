<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Cylinder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CylinderRequestStore;
use App\Http\Requests\Admin\CylinderRequestUpdate;
use App\Http\Resources\CylinderResource;

class CylinderController extends Controller
{
    public function index()
    {
        $cylinders = Cylinder::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return CylinderResource::collection($cylinders);
    }

    public function store(CylinderRequestStore $request)
    {
        $cylinder = Cylinder::create($request->only(['name']));

        return new CylinderResource($cylinder);
    }
    
    public function update(CylinderRequestUpdate $request,  Cylinder $cylinder)
    {
        $cylinder->update($request->only(['name']));

        return new CylinderResource($cylinder);
    }

    public function destroy(Cylinder $cylinder)
    {
        $cylinder->delete();

        return response([],204);
    }
}
