<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Admin\ModelRequestUpdate;
use App\Http\Resources\Admin\ModelResource;
use App\Models\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index(Request $request)
    {
        return ModelResource::collection(
            Model::query()
                ->search()
                ->brandId()
                ->with('brand')
                ->orderByDesc('brand_id')
                ->orderBy('name')
                ->paginateIf()
        );
    }

}
