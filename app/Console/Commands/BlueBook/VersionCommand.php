<?php

namespace App\Console\Commands\BlueBook;

use App\Models\Model;
use App\Models\Version;
use Illuminate\Console\Command;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Services\BlueBook\Soap\Client;

class VersionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blue-book:replicate-versions {--refreshKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replicate versions from blue book';

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

        if ($version = Version::latest()->first()) {
            $models = Model::select(['id', 'brand_id'])->where('id', '>', $version->model_id - 1)->get();
        } else {
            $models = Model::select(['id', 'brand_id'])->get();
        }

        foreach ($models as $model) {

            foreach($years as $year){

                $versions = $client->getVersionsByYearBrandModel($year->Clave, $model->brand_id, $model->id)
                    ->ObtenerVersionesPorAnioMarcaModeloResult;

                if (property_exists($versions, 'Catalogo')) {
                    if (is_array($versions->Catalogo)) {
                        foreach($versions->Catalogo as $version){
                            $this->updateOrCreate(
                                $version->Clave,
                                $model->id,
                                $version->Nombre,
                                $year->Clave

                            );
                        }
                    } else {
                        $this->updateOrCreate(
                            $versions->Catalogo->Clave,
                            $model->id,
                            $versions->Catalogo->Nombre,
                            $year->Clave

                        );
                    }
                }

            }

        }

        // CON CREDENCIALES DE TESTING, ESTE COMANDO LE PEGA AL WEBSERVICE 231 VECES.

        return true;
    }

    private function updateOrCreate($id, $modelId, $name, $year)
    {
        Version::updateOrCreate([
            'id' => $id
        ],[
            'model_id'  => $modelId,
            'name'      => $name,
            'year'      => $year
        ]);
    }
}
