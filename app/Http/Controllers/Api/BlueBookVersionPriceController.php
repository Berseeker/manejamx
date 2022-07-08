<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Site\VersionPriceResource;
use App\Services\BlueBook\Soap\Client;
use Artisaninweb\SoapWrapper\SoapWrapper;

class BlueBookVersionPriceController extends Controller
{

    public function show($version)
    {
        if(app()->environment('local')) {
            return [
                'data'  => [
                    'sell'     => 100,
                    'buy'      => 100,
                    'currency' => 'US'
                ]
            ];
        }

        $client = new Client(new SoapWrapper);
        $price = $client->getPriceVersionByKey($version)->ObtenerPrecioVersionPorClaveResult;

        return new VersionPriceResource($price);
    }
}
