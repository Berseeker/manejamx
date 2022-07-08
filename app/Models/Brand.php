<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function logo()
    {
        return $this->morphOne(File::class, 'fileable')->latest();
    }

    public function models()
    {
        return $this->hasMany(\App\Models\Model::class);
    }

    public function versions()
    {
        return $this->hasManyThrough(Version::class, \App\Models\Model::class);
    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('name', 'LIKE', '%'.request()->search.'%');
        });
    }

    /* methods */


    public function addLogo()
    {

        if(request()->hasFile('file')){
            $file = request()->file('file');

            $path = $file->store('brands/logos/'.$this->id, 'public');

            $this->logo()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
                'name'     => $file->getClientOriginalName(),
            ]);
        }

        return $this;
    }


}
