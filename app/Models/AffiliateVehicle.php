<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AffiliateVehicle extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // relations

    public function exterior_colors(): BelongsToMany
    {
        return $this->belongsToMany(
            Color::class,
            'affiliate_vehicle_colors',
            'vehicle_id',
            'color_id'
        )
        ->wherePivot('interior', false)
        ->wherePivot('exterior', true);
    }

    public function interior_colors(): BelongsToMany
    {
        return $this->belongsToMany(
            Color::class,
            'affiliate_vehicle_colors',
            'vehicle_id',
            'color_id'
        )
        ->wherePivot('interior', true)
        ->wherePivot('exterior', false);
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Model::class);
    }

    public function version(): BelongsTo
    {
        return $this->belongsTo(Version::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // methods

    public function addColors($exteriorColors, $interiorColors)
    {
        foreach ($exteriorColors as $color) {
            $this->exterior_colors()->attach($color, ['exterior' => true]);
        }

        foreach ($interiorColors as $color) {
            $this->interior_colors()->attach($color, ['interior' => true]);
        }
    }

    public function addFile($file)
    {
        $path = $file->store('affiliates_vehicles', 'public');

        $this->files()->create([
            'path'     => $path,
            'filename' => $file->getClientOriginalName(),
            'name'     => $file->getClientOriginalName(),
        ]);
    }
}
