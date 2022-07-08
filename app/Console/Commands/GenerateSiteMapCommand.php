<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use App\Models\VehicleStatus;
use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSiteMapCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate Sitemap';

    public function handle()
    {
        $sitemap = SitemapGenerator::create(config('app.url'))->getSitemap();

        $vehicles = Vehicle::query()->where('status_id', VehicleStatus::AVAILABLE)->get();

        foreach($vehicles as $vehicle) {
            $sitemap->add(Url::create('/autos/'.$vehicle->getSlug())
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.1));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
