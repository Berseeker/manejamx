<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Transmission;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransmissionResource;

class RestoreTransmissionController extends Controller
{
    
    public function update($transmission_id)
    {
        $transmission = Transmission::withTrashed()->find($transmission_id);
        $transmission->restore();

        return new TransmissionResource($transmission);
    }

}
