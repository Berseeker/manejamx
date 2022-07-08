<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;

class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(
            User::where('client', true)
                ->paginate(15)
        );
    }
}
