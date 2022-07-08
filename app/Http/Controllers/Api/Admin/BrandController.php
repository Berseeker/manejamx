<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequestUpdate;
use App\Http\Resources\BrandResource;
use App\Services\BlueBook\Soap\Client;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BrandController extends Controller
{
    public function index(Request $request)
    {

        if(App::environment(['local', 'production'])){
            if($request->filled(['year'])){
                $client = new Client(new SoapWrapper());
                $brands = $client->getBrandsByYear($request->year)
                    ->ObtenerMarcasPorAnioResult;

                if (property_exists($brands, 'Catalogo')) {
                    if (is_array($brands->Catalogo)) {
                        foreach($brands->Catalogo as $brand){
                            Brand::updateOrCreate([
                                'id' => $brand->Clave,
                            ],
                                [
                                    'name'      => $brand->Nombre
                                ]);
                        }
                    } else {
                        Brand::updateOrCreate([
                            'id' => $brands->Catalogo->Clave,
                        ],
                            [
                                'name'      => $brands->Catalogo->Nombre
                            ]);
                    }
                }
            }
        }

        $brands = Brand::query()
            ->search()
            ->orderBy('name')
            ->with(['logo'])
            ->paginateIf();

        return BrandResource::collection($brands);
    }

    public function update(BrandRequestUpdate $request, Brand $brand)
    {
        $brand->addLogo();

        return new BrandResource($brand);
    }

    public function store(Request $request)
    {
        $brand = Brand::create([
            'name' => $request->name
        ]);

        return new BrandResource($brand);
    }
}
