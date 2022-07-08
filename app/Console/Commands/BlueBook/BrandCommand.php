<?php

namespace App\Console\Commands\BlueBook;

use App\Models\Brand;
use Illuminate\Console\Command;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Services\BlueBook\Soap\Client;

class BrandCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blue-book:replicate-brands {--refreshKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replicate brands from blue book';

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
        $client = new Client(new SoapWrapper, $this->option('refreshKey'));

        $years = $client->getYears()->ObtenerAniosResult->Catalogo;

        foreach($years as $year){

            $brands = $client->getBrandsByYear($year->Clave)->ObtenerMarcasPorAnioResult->Catalogo;

            foreach($brands as $brand){
                Brand::updateOrCreate([
                    'id' => $brand->Clave
                ],[
                    'name' => $brand->Nombre
                ]);
            }


        }

        return true;

    }
}
