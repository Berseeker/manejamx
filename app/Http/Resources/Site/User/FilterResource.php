<?php

namespace App\Http\Resources\Site\User;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterResource extends JsonResource
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
            'id'            => $this->id,
            'email'         => $this->email,
            'name'          => $this->name,
            'filters'       => $this->filters,
            'filter_names'  => json_decode($this->filter_names)
        ];
    }
}
