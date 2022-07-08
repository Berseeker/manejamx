<?php

namespace App\Models\Blog;

use App\Models\File;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'blog_posts';
    protected $guarded = [];

    /* relations */

    public function categories()
    {
        return $this->belongsToMany(
            Category::class, 'blog_post_category', 'post_id', 'category_id'
        );
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function url()
    {
        return route('site.blog.post', [$this->id, Str::slug($this->title)]);
    }

    /*scopes*/

    public function scopeName($query)
    {
        return $query->when(request()->filled('name'), function($q){
            $q->where('title', 'LIKE', '%'.request()->name.'%');
        });
    }

    public function scopeCategory($query)
    {
        return $query->when(request()->filled('category_id'), function($query){
            $query->whereHas('categories', function($query) {
                $query->where('id', request()->category_id);
            });
        });
    }
}
