<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Blog\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $posts = Category::query()
            ->orderBy('name')
            ->paginateIf();

        return CategoryResource::collection($posts);
    }

}