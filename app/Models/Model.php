<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends LaravelModel
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function versions()
    {
        return $this->hasMany(Version::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('name', 'LIKE', '%'.request()->search.'%');
        });
    }

    public function scopeBrandId($query)
    {
        return $query->when(request()->filled('brand_id'), function($query){
            $query->where('brand_id', request()->brand_id);
        });
    }
}
