<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Resources\Admin\VehicleResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleImageRequestStore;
use App\Models\File;
use App\Models\Vehicle;

class VehicleImageController extends Controller
{

    public function store(VehicleImageRequestStore $request, Vehicle $vehicle)
    {
        $vehicle->addImages();

        return new VehicleResource($vehicle->load(['images', 'three_sixty_images', 'interior_images', 'exterior_images', 'principal_images' ]));
    }


    public function destroy(Vehicle $vehicle, File $file)
    {
        $file->delete();

        return new VehicleResource($vehicle->load(['images', 'three_sixty_images', 'interior_images', 'exterior_images']));
    }
}
