<?php

namespace App\Http\Resources\Site;


use Illuminate\Http\Resources\Json\JsonResource;

class VehicleSellRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
               
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'last_name'  => $this->last_name,
            'phone'      => $this->phone,
            'email'      => $this->email,
            'year'       => $this->year,
            'odometer'   => $this->odometer,
            'sell_price' => $this->sell_price,
        ];
    }
}
