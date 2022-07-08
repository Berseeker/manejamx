<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExternalVehicle extends Model
{
    use HasFactory;

    public function scopeAvg($query)
    {
        if (request()->filled('selectedMake') && request()->filled('selectedModel') && request()->filled('selectedVersion')) {
            return $query
                ->select(DB::raw('
                make,
                model,
                version,
                year,
                avg(price) AS avg_price,
                max(price) AS max_price,
                min(price) AS min_price,
                AVG(km) AS avg_km

            '))
                ->where('price', '>', 10000)
                ->where('make', request()->selectedMake)
                ->where('model', request()->selectedModel)
                ->where('version', request()->selectedVersion === 'null' ? '' : request()->selectedVersion)
                ->groupBy('make')
                ->groupBy('model')
                ->groupBy('version')
                ->groupBy('year')
                ->orderBy('year');
        }


        if (request()->filled('selectedMake') && request()->filled('selectedModel')) {
            return $query
                ->select(DB::raw('
                make,
                model,
                version,
                count(DISTINCT year) AS year_count,
                avg(price) AS avg_price,
                max(price) AS max_price,
                min(price) AS min_price,
                AVG(km) AS avg_km

            '))
                ->where('price', '>', 10000)
                ->where('make', request()->selectedMake)
                ->where('model', request()->selectedModel)
                ->groupBy('make')
                ->groupBy('model')
                ->groupBy('version')
                ->orderBy('version');
        }

        if (request()->filled('selectedMake')) {
            return $query->when(request()->filled('selectedMake'), function($query){
                $query
                    ->select(DB::raw('
                make,
                model,
                count(DISTINCT version) AS version_count,
                avg(price) AS avg_price,
                max(price) AS max_price,
                min(price) AS min_price,
                AVG(km) AS avg_km

            '))
                    ->where('price', '>', 10000)
                    ->where('make', request()->selectedMake)
                    ->groupBy('make')
                    ->groupBy('model')
                    ->orderBy('model');
            });
        }

        return $query->orderBy('make')
            ->select(DB::raw('make, count(DISTINCT(model)) as model_count, avg(price) as avg_price, max(price) as max_price, min(price) as min_price, AVG(km) AS avg_km'))
            ->where('price', '>', 10000)
            ->groupBy('make');
    }
}
