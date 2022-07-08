<?php

namespace App\Http\Controllers\Api;

use App\Models\Transmission;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransmissionResource;

class TransmissionController extends Controller
{
    public function index()
    {
        $transmissions = Transmission::query()
            ->search()
            ->orderByDesc('created_at')
            ->paginateIf();

        return TransmissionResource::collection($transmissions);
    }

}
