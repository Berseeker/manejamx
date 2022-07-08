<?php

namespace App\Console\Commands\BlueBook;

use App\Models\Brand;
use App\Models\Model;
use Illuminate\Console\Command;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Services\BlueBook\Soap\Client;

class ModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blue-book:replicate-models {--refreshKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replicate models from blue book';

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

        $brands = Brand::all();

        foreach ($brands as $brand) {

            foreach($years as $year){

                $models = $client->getModelsByYearBrand($year->Clave, $brand->id)
                    ->ObtenerModelosPorAnioMarcaResult;

                if (property_exists($models, 'Catalogo')) {
                    if (is_array($models->Catalogo)) {
                        foreach($models->Catalogo as $model){
                            $this->updateOrCreate($model->Clave, $brand->id, $model->Nombre);

                        }
                    } else {
                        $this->updateOrCreate($models->Catalogo->Clave, $brand->id, $models->Catalogo->Nombre);
                    }
                }

            }

        }

        return true;
    }

    private function updateOrCreate($id, $brandId, $name)
    {
        Model::updateOrCreate([
            'id' => $id
        ],[
            'brand_id'  => $brandId,
            'name'      => $name
        ]);
    }

    // CON CREDENCIALES DE TESTING, ESTE COMANDO LE PEGA AL WEBSERVICE 46 VECES.
}
