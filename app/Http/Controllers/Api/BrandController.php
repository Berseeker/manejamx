<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::query()
            ->search()
            ->with(['logo'])
            ->orderBy('name')
            ->paginateIf();

        return BrandResource::collection($brands);
    }
}
