<?php

namespace App\Http\Resources\Admin;


use Illuminate\Http\Resources\Json\JsonResource;

class VehicleQuoteRequestResource extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->name,
            'last_name'    => $this->last_name,
            'phone'        => $this->phone,
            'email'        => $this->email,
            'description'  => $this->description,
            'date'         => $this->date,
            'time'         => $this->time,
            'observations' => $this->observations,
            'answered'     => $this->answered,
            'created_at'   => $this->created_at->format('d-m-Y H:i'),
            'vehicle'      => new VehicleResource($this->whenLoaded('vehicle')) 
        ];
    }
}
