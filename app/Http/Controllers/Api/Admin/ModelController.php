<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\ModelRequestUpdate;
use App\Http\Resources\Admin\ModelResource;
use App\Models\Model;
use App\Http\Controllers\Controller;
use App\Services\BlueBook\Soap\Client;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ModelController extends Controller
{
    public function index(Request $request)
    {

        if(App::environment(['local', 'production'])){
            if($request->filled(['year', 'brand_id'])){
                $client = new Client(new SoapWrapper());
                $models = $client->getModelsByYearBrand($request->year, $request->brand_id)
                    ->ObtenerModelosPorAnioMarcaResult;

                if (property_exists($models, 'Catalogo')) {
                    if (is_array($models->Catalogo)) {
                        foreach($models->Catalogo as $model){
                            Model::updateOrCreate([
                                'id' => ($model->Clave . $request->brand_id),
                                'brand_id'  => $request->brand_id,
                            ],
                                [
                                    'brand_id'  => $request->brand_id,
                                    'name'      => $model->Nombre
                                ]);
                        }
                    } else {
                        Model::updateOrCreate([
                            'id' => ($models->Catalogo->Clave . $request->brand_id),
                            'brand_id'  => $request->brand_id,
                        ],
                            [
                                'brand_id'  => $request->brand_id,
                                'name'      => $models->Catalogo->Nombre
                            ]);
                    }
                }
            }
        }

        $models =  Model::brandId()
            ->search()
            ->with('brand')
            ->orderByDesc('brand_id')
            ->orderBy('name')
            ->paginateIf();

        return ModelResource::collection($models);
    }

    public function update(Model $model, ModelRequestUpdate $request)
    {
        $model->update([
            'name' => $request->name
        ]);

        return new ModelResource($model);
    }

    public function store(Request $request)
    {
        $model = Model::create([
            'name'      => $request->name,
            'brand_id'  => $request->brand_id
        ]);

        return new ModelResource($model);
    }
}
