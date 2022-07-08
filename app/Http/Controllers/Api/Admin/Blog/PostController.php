<?php

namespace App\Http\Controllers\Api\Admin\Blog;

use App\Models\Blog\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\PostStore;
use App\Http\Requests\Admin\Blog\PostUpdate;
use App\Http\Resources\Admin\Blog\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::query()
            ->name()
            ->category()
            ->latest('id')
            ->with(['categories', 'author'])
            ->paginateIf();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post->load(['categories']);

        return new PostResource($post);
    }

    public function store(PostStore $request)
    {
        $request->merge(['author_id' => $request->user('api')->id]);

        $post = Post::create($request->only(['title', 'content', 'author_id']));

        if($request->filled('categories')) {
            $post->categories()->attach($request->categories);
        }

        if($request->hasFile('file')) {
            $path = $request->file->store('posts/'.$post->id, 'public');

            $post->file()->create([
                'path'      => $path,
                'filename'  => $request->file->getClientOriginalName(),
                'name'      => $request->file->getClientOriginalName()
            ]);
        }

        return new PostResource($post);
    }

    public function update(PostUpdate $request, Post $post)
    {
        $request->merge(['author_id' => $request->user('api')->id]);

        $post->update($request->only(['title', 'content', 'author_id']));

        if($request->filled('categories')) {
            $post->categories()->sync($request->categories);
        }

        if($request->hasFile('file')) {
            $path = $request->file->store('posts/'.$post->id, 'public');

            $post->file()->updateOrCreate([
                'fileable_id'   => $post->id,
                'fileable_type' => Post::class
            ], [
                'path'      => $path,
                'filename'  => $request->file->getClientOriginalName(),
                'name'      => $request->file->getClientOriginalName()
            ]);
        }

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response([], 204);
    }
}
