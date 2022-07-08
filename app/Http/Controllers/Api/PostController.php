<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->category()
            ->with(['categories', 'file', 'author', ])
            ->orderByDesc('created_at')
            ->paginateIf();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post->load(['categories', 'file']));
    }

}