<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DriveResource;
use App\Models\Drive;

class RestoreDriveController extends Controller
{
    
    public function update($drive_id)
    {
        $drive = Drive::withTrashed()->find($drive_id);
        $drive->restore();

        return new DriveResource($drive);
    }

}
