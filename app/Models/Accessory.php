<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Accessory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function type()
    {
        return  $this->belongsTo(AccessoryType::class);
    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('name', 'LIKE', '%'.request()->search.'%');
        });
    }
    
    public function scopeType($query)
    {
        return $query->when(request()->filled('type_id'), function($query){
            $query->where('type_id', request()->type_id);
        });
    }

    public function scopeWithTrash($query)
    {
        return $query->when(request()->filled('with_trash'), function($query){
            $query->withTrashed();
        });
    }
}
