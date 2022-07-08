<?php

namespace App\Console\Commands\BlueBook;

use App\Models\Version;
use Illuminate\Console\Command;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Services\BlueBook\Soap\Client;

class PriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blue-book:replicate-prices {--refreshKey}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Replicate prices from blue book';

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

        $versions = Version::all();

        foreach ($versions as $version) {

            $price = $client->getPriceVersionByKey($version->id)->ObtenerPrecioVersionPorClaveResult;

            $version->update([
                'sell'      => $price->Venta,
                'buy'       => $price->Compra,
                'currency'  => $price->Moneda
            ]);
        }

        return true;
    }
}
