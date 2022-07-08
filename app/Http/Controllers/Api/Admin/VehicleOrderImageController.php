<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class VehicleOrderImageController extends Controller
{

    public function update(Request $request, $vehicle)
    {
        
        foreach ($request->order as $id => $order) {
            File::findOrFail($id)->update(['order'=> $order]);
        }

        return response()->json([],201);
    }


   
}
