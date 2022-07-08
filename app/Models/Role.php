<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    protected $guard_name = 'api';

    const AFFILIATE = 4;

    public function scopeWithPermissions($query)
    {
        return $query->when(request()->filled(['with']), function($q) {
            if (in_array('permissions', request()->with)) {
                $q->with('permissions');
            }
        });
    }
}
