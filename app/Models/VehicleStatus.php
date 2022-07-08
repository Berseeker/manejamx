<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'vehicle_statuses';
    protected $guarded = [];

    const AVAILABLE = 1;
    const RESERVED  = 2;
    const SOLD      = 3;
}
