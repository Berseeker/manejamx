<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\ModelResource;
use App\Http\Resources\Admin\VersionResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\FileResource;
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
            'id'              => $this->id,
            'created_at'      => $this->created_at->format('d-m-y'),
            'name'            => $this->name,
            'last_name'       => $this->last_name,
            'email'           => $this->email,
            'answered'        => $this->answered,
            'observations'    => $this->observations,
            'phone'           => $this->email,
            'sell_price'      => $this->sell_price,
            'year'            => $this->year,
            'odometer'        => $this->odometer,
            'brand'           => new BrandResource($this->whenLoaded('brand')),
            'model'           => new ModelResource($this->whenLoaded('model')),
            'version'         => new VersionResource($this->whenLoaded('version')),
            'colors'          => ColorResource::collection($this->whenLoaded('colors')),
            'interior_colors' => ColorResource::collection($this->whenLoaded('interior_colors')),
            'images'          => FileResource::collection($this->whenLoaded('images')),
        ];
    }
}
