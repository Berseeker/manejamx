<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Models\Blog\Category;
use App\Http\Resources\Admin\Blog\CategoryResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\CategoryStore;
use App\Http\Requests\Admin\Blog\CategoryUpdate;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::name()->orderBy('name')->paginateIf();

        return CategoryResource::collection($categories);
    }

    public function store(CategoryStore $request)
    {
        $category = Category::create($request->only(['name']));

        return new CategoryResource($category);
    }

    public function update(CategoryUpdate $request, Category $category)
    {
        $category->update($request->only(['name']));

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response([], 204);
    }
}
