<?php

namespace App\Providers;


use Carbon\Laravel\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        Builder::macro('paginateIf', function() {
            if(request()->has('page')) {
                return $this->paginate();
            }
            return $this->get();
        });
    }

}
