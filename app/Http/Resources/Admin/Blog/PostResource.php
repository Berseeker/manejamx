<?php

namespace App\Http\Resources\Admin\Blog;

use App\Http\Resources\Admin\Blog\CategoryResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'content'       => $this->content,
            'short_content' => Str::limit( strip_tags($this->content)) ,
            'slug'          => Str::slug($this->title),
            'edit_url'      => url('admin/blog/posts/edit/'.$this->id),
            'categories'    => CategoryResource::collection($this->whenLoaded('categories')),
            'author'        => new UserResource($this->whenLoaded('author')),
            'file'          => new FileResource($this->whenLoaded('file'))
        ];
    }
}
