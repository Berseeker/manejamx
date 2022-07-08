<?php

namespace App\Services\BlueBook\Soap;

use \Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\Cache;

class Client
{
    const WSDL = 'https://www.libroazul.com/ws/wslibroazul.asmx?WSDL';

    const KEY_TTL = 3600;

    private $client;

    private $key;

    private $refreshKey;

    public function __construct(SoapWrapper $client, $refreshKey = false)
    {
        $this->client = $client;

        $this->refreshKey = $refreshKey;

        $this->initialize();
    }

    private function initialize()
    {
        $this->client->add('bluebook', function ($service) {

            $service
                ->wsdl(self::WSDL)
                ->trace(true);

        });

        if ($this->refreshKey) {
            $this->refreshKey();
        } else {
            $this->setKey();
        }

    }

    private function setKey()
    {
        $this->key = Cache::remember('libro_azul_key', self::KEY_TTL, function () {
            return $this->auth()->IniciarSesionResult;
        });
    }

    public function refreshKey()
    {
        Cache::forget('libro_azul_key');

        $this->setKey();
    }

    public function auth()
    {
        return $this->client->call(
            'bluebook.IniciarSesion',
            [
                [
                    'Usuario'    => env('BLUE_BOOK_USERNAME'),
                    'Contrasena' => env('BLUE_BOOK_PASSWORD')
                ]
            ]
        );
    }

    public function getEditions()
    {
        return $this->client->call(
            'bluebook.ObtenerEdiciones',
            [
                [
                    'Llave' => $this->key
                ]
            ]
        );
    }

    public function getYears($edition = 0)
    {
        return $this->client->call(
            'bluebook.ObtenerAnios',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'Edicion' => $edition
                ]
            ]
        );
    }

    public function getBrandsByYear($year, $edition = 0)
    {
        return $this->client->call(
            'bluebook.ObtenerMarcasPorAnio',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'ClaveAnio' => $year,
                    'Edicion' => $edition
                ]
            ]
        );
    }

    public function getModelsByYearBrand($year, $brand, $edition = 0)
    {
        return $this->client->call(
            'bluebook.ObtenerModelosPorAnioMarca',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'ClaveAnio' => $year,
                    'ClaveMarca' => $brand,
                    'Edicion' => $edition
                ]
            ]
        );
    }

    public function getVersionsByYearBrandModel($year, $brand, $model, $edition = 0)
    {
        // Quitar el brand_id en el id del modelo.
        if (strlen($model) === 6) {
            $model = substr($model, 0, -3);
        }
        return $this->client->call(
            'bluebook.ObtenerVersionesPorAnioMarcaModelo',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'ClaveAnio' => $year,
                    'ClaveMarca' => $brand,
                    'ClaveModelo' => $model,
                    'Edicion' => $edition
                ]
            ]
        );
    }

    public function GetVersionsByYearBrandModelDetails($year, $brand, $model, $edition = 0)
    {
        return $this->client->call(
            'bluebook.ObtenerVersionesPorAnioMarcaModeloDetalles',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'ClaveAnio' => $year,
                    'ClaveMarca' => $brand,
                    'ClaveModelo' => $model,
                    'Edicion' => $edition
                ]
            ]
        );
    }

    public function getPriceVersionByKey($version, $edition = 0)
    {
        return $this->client->call(
            'bluebook.ObtenerPrecioVersionPorClave',
            [
                [
                    'Llave' => $this->key,
                    'Clase' => 0,
                    'ClaveVersion' => $version,
                    'Edicion' => $edition
                ]
            ]
        );
    }

}
