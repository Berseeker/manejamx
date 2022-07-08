<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\VehicleActivated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class NotifyOnVehicleActivation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $vehicle;

    /**
     * Create a new job instance.
     *
     * @param $vehicle
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->getUsersToNotify();

        foreach ($users as $user) {
            foreach ($user->filters as $filter) {
                if ($this->shouldNotify($filter->filters)) {
                    Notification::route('mail', $filter->email)
                        ->notify(new VehicleActivated($this->vehicle));
                }
            }
        }
    }

    private function getUsersToNotify()
    {
        return User::where('notifications', true)
            ->where('client', true)
            ->has('filters')
            ->get();
    }

    private function shouldNotify($filters)
    {
        if (
            $this->checkBrand(isset($filters->brand_id) ? $filters->brand_id : '') &&
            $this->checkModels($filters->models) &&
            $this->checkPrices($filters->price) &&
            $this->checkYears($filters->year) &&
            $this->checkOdometers($filters->odometer) &&
            $this->checkBodyTypes($filters->body_types) &&
            $this->checkAccessories($filters->accessories) &&
            $this->checkFuels($filters->fuels) &&
            $this->checkCylinders($filters->cylinders) &&
            $this->checkColors($filters->colors) &&
            $this->checkTransmissions($filters->transmissions) &&
            $this->checkDrives($filters->drives)

        ) {
            return true;
        }

        return false;
    }

    private function checkBrand(string $brandId)
    {
        if ($brandId == '' || $this->vehicle->brand_id == $brandId) {
            return true;
        }

        return false;
    }

    private function checkModels(array $models)
    {
        if (!count($models) || in_array($this->vehicle->model_id, $models)) {
            return true;
        }

        return false;
    }

    private function checkPrices(array $price)
    {
        if (
            !count($price) ||
            $this->vehicle->sell_price >= $price[0] &&
            $this->vehicle->sell_price <= $price[1]
        ) {
            return true;
        }

        return false;
    }

    private function checkYears(array $year)
    {
        if (
            !count($year) ||
            $this->vehicle->year >= $year[0] &&
            $this->vehicle->year <= $year[1]
        ) {
            return true;
        }

        return false;
    }

    private function checkOdometers(array $odometer)
    {
        if (
            !count($odometer) ||
            $this->vehicle->odometer >= $odometer[0] &&
            $this->vehicle->odometer <= $odometer[1]
        ) {
            return true;
        }

        return false;
    }

    private function checkBodyTypes(array $bodyTypes)
    {
        if (
            !count($bodyTypes) ||
            in_array($this->vehicle->body_type_id, $bodyTypes)
        ) {
            return true;
        }

        return false;
    }

    private function checkAccessories(array $accessories)
    {
        if (
            !count($accessories) ||
            count(
                array_intersect($this->vehicle->accessories->pluck(['id'])->toArray(), $accessories)
            ) == count($accessories)
        ) {
            return true;
        }

        return false;
    }

    private function checkFuels(array $fuels)
    {
        if (
            !count($fuels) ||
            count(
                array_intersect($this->vehicle->accessories->pluck(['id'])->toArray(), $fuels)
            ) > 0
        ) {
            return true;
        }

        return false;
    }

    private function checkCylinders(array $cylinders)
    {
        if (
            !count($cylinders) ||
            count(
                array_intersect($this->vehicle->cylinders->pluck(['id'])->toArray(), $cylinders)
            ) > 0
        ) {
            return true;
        }

        return false;
    }

    private function checkColors(array $colors)
    {
        if (
            !count($colors) ||
            count(
                array_intersect($this->vehicle->colors->pluck(['id'])->toArray(), $colors)
            ) > 0
        ) {
            return true;
        }

        return false;
    }

    private function checkTransmissions(array $transmissions)
    {
        if (
            !count($transmissions) ||
            count(
                array_intersect($this->vehicle->transmissions->pluck(['id'])->toArray(), $transmissions)
            ) > 0
        ) {
            return true;
        }

        return false;
    }

    private function checkDrives(array $drives)
    {
        if (
            !count($drives) ||
            count(
                array_intersect($this->vehicle->drives->pluck(['id'])->toArray(), $drives)
            ) > 0
        ) {
            return true;
        }

        return false;
    }
}
