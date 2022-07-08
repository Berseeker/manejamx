<?php

namespace App\Http\Controllers;

use App\Models\Blog\Post;

class PostController extends Controller
{
    public function show(Post $post, $slug)
    {
        return view('site.blog.show', compact(['post']));
    }
}
