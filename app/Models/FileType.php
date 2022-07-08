<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileType extends Model
{
    use HasFactory;
    use SoftDeletes;

    const THREE_SIXTY = 1;
    const EXTERIOR    = 2;
    const INTERIOR    = 3;
    const PRINCIPAL   = 4;
    const ID          = 5;
    const RFC         = 6;
    const ADDRESS_VOUCHER = 7;
    const CONSTITUTIVE_ACT = 8;
    const BANK_COVER  = 9;
}
