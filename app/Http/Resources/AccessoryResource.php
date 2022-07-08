<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessoryResource extends JsonResource
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
            'deleted_at' => $this->deleted_at,
            'active'     => false,
            'type'       => new AccessoryTypeResource($this->whenLoaded('type'))
        ];
    }
}
