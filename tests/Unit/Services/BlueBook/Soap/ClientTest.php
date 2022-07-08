<?php

namespace Tests\Unit\Services\BlueBook\Soap;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Services\BlueBook\Soap\Client;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function testGetEditions()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerEdicionesResult',
            $client->getEditions());
    }

    public function testGetYears()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerAniosResult',
            $client->getYears());
    }

    public function testGetBrandsByYear()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerMarcasPorAnioResult',
            $client->getBrandsByYear(2018));
    }

    public function testGetModelsByYearBrand()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerModelosPorAnioMarcaResult',
            $client->getModelsByYearBrand(2018, 100));
    }

    public function testGetVersionsByYearBrandModel()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerVersionesPorAnioMarcaModeloResult',
            $client->getVersionsByYearBrandModel(2018, 100, 1));
    }

    public function testGetPriceVersionByKey()
    {
        $client = new Client(new SoapWrapper);

        $this->assertObjectHasAttribute(
            'ObtenerPrecioVersionPorClaveResult',
            $client->getPriceVersionByKey(2018, 100));
    }
}
