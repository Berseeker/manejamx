<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Version extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function brand()
    {
        return $this->model->brand();
    }

    public function model()
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('name', 'LIKE', '%'.request()->search.'%');
        });
    }
    
    public function scopeYear($query)
    {
        return $query->when(request()->filled('year'), function($query){
            $query->where('year', request()->year);
        });
    }

    public function scopeBrandId($query)
    {
        return $query->when(request()->filled('brand_id'), function($query){
            $query->whereHas('model.brand', function($brand) {
                $brand->where('brand_id', request()->brand_id);
            });
        });
    }

    public function scopeModelId($query)
    {
        return $query->when(request()->filled('model_id'), function($query){
            $query->where('model_id', request()->model_id);
        });
    }

}
