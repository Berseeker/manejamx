<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffiliateLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // relations

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
