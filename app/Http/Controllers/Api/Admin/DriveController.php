<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Drive;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriveRequestStore;
use App\Http\Requests\Admin\DriveRequestUpdate;
use App\Http\Resources\DriveResource;

class DriveController extends Controller
{
    public function index()
    {
        $drives = Drive::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return DriveResource::collection($drives);
    }

    public function store(DriveRequestStore $request)
    {
        $drive = Drive::create($request->only(['name']));

        return new DriveResource($drive);
    }
    
    public function update(DriveRequestUpdate $request,  Drive $drive)
    {
        $drive->update($request->only(['name']));

        return new DriveResource($drive);
    }

    public function destroy(Drive $drive)
    {
        $drive->delete();

        return response([],204);
    }
}
