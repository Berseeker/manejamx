<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /* relations */

    public function file()
    {
        return $this->morphOne(File::class, 'fileable')->latest();

    }

    /* scopes */

    public function scopeSearch($query)
    {
        return $query->when(request()->filled('search'), function($query){
            $query->where('name', 'LIKE', '%'.request()->search.'%');
        });
    }

    public function scopeWithTrash($query)
    {
        return $query->when(request()->filled('with_trash'), function($query){
            $query->withTrashed();
        });
    }



    /* methods */


    public function addFile()
    {

        if(request()->hasFile('file')){
            $file = request()->file('file');

            $path = $file->store('body_types/images/'.$this->id, 'public');

            $this->file()->create([
                'path'     => $path,
                'filename' => $file->getClientOriginalName(),
                'name'     => $file->getClientOriginalName(),
            ]);
        }

        return $this;
    }

}
