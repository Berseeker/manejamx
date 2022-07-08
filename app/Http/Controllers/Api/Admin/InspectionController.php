<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\InspectionRequestStore;
use App\Http\Requests\Admin\InspectionRequestUpdate;
use App\Http\Resources\InspectionResource;
use App\Models\Inspection;
use App\Http\Controllers\Controller;

class InspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return InspectionResource::collection($inspections);
    }

    public function store(InspectionRequestStore $request)
    {
        $inspection = Inspection::create($request->only(['name']));

        return new InspectionResource($inspection);
    }
    
    public function update(InspectionRequestUpdate $request,  Inspection $inspection)
    {
        $inspection->update($request->only(['name']));

        return new InspectionResource($inspection);
    }

    public function destroy(Inspection $inspection)
    {
        $inspection->delete();

        return response([],204);
    }
}
