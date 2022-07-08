<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\FileType;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileTypeResource;

class FileTypeController extends Controller
{
    public function index()
    {
        $types = FileType::query()
            ->paginateIf();

        return FileTypeResource::collection($types);
    }

}
