<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BodyTypeResource extends JsonResource
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
            'file'       => new FileResource($this->whenLoaded('file'))
        ];
    }
}
