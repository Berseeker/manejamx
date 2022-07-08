<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'order'         => $this->order,
            'type_id'       => $this->description,
            'description'   => $this->description,
            'show_url'      => $this->showUrl(),
            'url'           => $this->showUrl(),
            'alt'           => $this->description,
            'type'          => new FileTypeResource($this->whenLoaded('type')),
        ];
    }
}
