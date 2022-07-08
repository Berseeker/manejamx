<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Davidcb\LaravelShortPixel\Facades\LaravelShortPixel;
use Illuminate\Console\Command;

class OptimizeVehicleImagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vehicle:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'optimized all vehicle images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            try {
                $result = LaravelShortPixel::fromFolder(storage_path('app/public/vehicles/'.$vehicle->id.'/images/'), storage_path('app/public/vehicles/'.$vehicle->id.'/images/'), []);
            } catch (\Throwable $th) {
                //dd($th);
            }

        }
    }
}
