<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\BodyType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BodyTypeRequestStore;
use App\Http\Requests\Admin\BodyTypeRequestUpdate;
use App\Http\Resources\BodyTypeResource;

class BodyTypeController extends Controller
{
    public function index()
    {
        $bodyTypes = BodyType::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->with(['file'])
            ->paginateIf();

        return BodyTypeResource::collection($bodyTypes);
    }

    public function store(BodyTypeRequestStore $request)
    {
        $bodyType =  BodyType::create($request->only(['name']));
        $bodyType->addFile();

        return new BodyTypeResource($bodyType);
    }
    
    public function update(BodyTypeRequestUpdate $request, BodyType $bodyType)
    {
        $bodyType->update($request->only(['name']));
        $bodyType->addFile();

        return new BodyTypeResource($bodyType);
    }
    
    public function destroy(BodyType $bodyType)
    {
        $bodyType->delete();

        return response([],204);
    }
}
