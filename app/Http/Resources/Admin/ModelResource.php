<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'brand_name'        => $this->brand->name.' '.$this->name,
            'brand_id'          => $this->brand_id,
            'brand'             => new BrandResource($this->whenLoaded('brand')),
            'versions_count'    => $this->versions->count(),
            'active'            => false
        ];
    }
}
