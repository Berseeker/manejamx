<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\VersionRequestUpdate;
use App\Http\Resources\Admin\VersionResource;
use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Services\BlueBook\Soap\Client;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\App;

class VersionController extends Controller
{
    public function index(Request $request)
    {
        if(App::environment(['local', 'production'])){

            if($request->filled(['year', 'brand_id', 'model_id'])){
                $client = new Client(new SoapWrapper);
                $versions = $client->getVersionsByYearBrandModel($request->year, $request->brand_id, $request->model_id)
                            ->ObtenerVersionesPorAnioMarcaModeloResult;
    
                if (property_exists($versions, 'Catalogo')) {
                    if (is_array($versions->Catalogo)) {
                        foreach($versions->Catalogo as $version){
                            Version::updateOrCreate([
                                'id' => $version->Clave,
                            ],
                            [
                                'model_id'  => $request->model_id,
                                'name'      => $version->Nombre,
                                'year'      => $request->year
                            ]);
                        }
                    } else {
                        Version::updateOrCreate([
                            'id' => $versions->Catalogo->Clave,
                        ],
                        [
                            'model_id'  => $request->model_id,
                            'name'      => $versions->Catalogo->Nombre,
                            'year'      => $request->year
                        ]);
                    }
                }
            }

        }

        $versions = Version::brandId()
            ->search()
            ->modelId()
            ->year()
            ->with('model.brand')
            ->orderBy('name')
            ->paginateIf();

        return VersionResource::collection($versions);
    }

    public function update(Version $version, VersionRequestUpdate $request)
    {
        $version->update([
            'name'      => $request->name,
            'year'      => $request->year,
            'sell'      => $request->sell,
            'buy'       => $request->buy,
            'currency'  => $request->currency,
        ]);

        return new VersionResource($version);
    }

    public function store(Request $request)
    {
        $version = Version::create([
            'name'      => $request->name,
            'model_id'  => $request->model_id,
            'year'      => $request->year,
        ]);

        return new VersionResource($version);
    }
}
