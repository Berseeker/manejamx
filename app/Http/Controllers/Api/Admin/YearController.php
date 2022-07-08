<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequestUpdate;
use App\Http\Resources\BrandResource;
use App\Services\BlueBook\Soap\Client;
use Artisaninweb\SoapWrapper\SoapWrapper;

class YearController extends Controller
{
    public function index()
    {

        $client = new Client(new SoapWrapper);

        $years = $client->getYears()->ObtenerAniosResult->Catalogo;
        
        dd($years);

        //return YearResource::collection($brands);
    }

    public function update(BrandRequestUpdate $request, Brand $brand)
    {
        $brand->addLogo();

        return new BrandResource($brand);
    }
}
