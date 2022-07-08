<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Transmission;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TransmissionRequestStore;
use App\Http\Requests\Admin\TransmissionRequestUpdate;
use App\Http\Resources\TransmissionResource;

class TransmissionController extends Controller
{
    public function index()
    {
        $transmissions = Transmission::query()
            ->withTrash()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return TransmissionResource::collection($transmissions);
    }

    public function store(TransmissionRequestStore $request)
    {
        $transmission = Transmission::create($request->only(['name']));

        return new TransmissionResource($transmission);
    }
    
    public function update(TransmissionRequestUpdate $request,  Transmission $transmission)
    {
        $transmission->update($request->only(['name']));

        return new TransmissionResource($transmission);
    }

    public function destroy(Transmission $transmission)
    {
        $transmission->delete();

        return response([],204);
    }
}
