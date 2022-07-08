<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
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
            'id'        => $this->id,
            'name'      => $this->name,
            'year'      => $this->year,
            'sell'      => $this->sell,
            'buy'       => $this->buy,
            'currency'  => $this->currency,
            'model'     => new ModelResource($this->whenLoaded('model')),
        ];
    }
}
