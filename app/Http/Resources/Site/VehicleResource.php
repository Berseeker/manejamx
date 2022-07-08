<?php

namespace App\Http\Resources\Site;

use App\Http\Resources\AccessoryResource;
use App\Http\Resources\Admin\ModelResource;
use App\Http\Resources\Admin\VehicleStatusResource;
use App\Http\Resources\Admin\VersionResource;
use App\Http\Resources\BodyTypeResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\CylinderResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\FuelResource;
use App\Http\Resources\InspectionResource;
use App\Http\Resources\TransmissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $threeSixtyImages = [];

        foreach($this->three_sixty_images as $image){
            array_push($threeSixtyImages, $image->showUrl());
        }

        return [
            'id'                 => $this->id,
            'sell_price'         => $this->sell_price,
            'year'               => $this->year,
            'doors'              => $this->doors,
            'keys'               => $this->keys,
            'odometer'           => $this->odometer,
            'vin'                => $this->vin,
            'fuel_consumption'   => $this->fuel_consumption,
            'three_sixty'        => $threeSixtyImages,
            'three_sixty_count'  => $this->three_sixty_images->count(),
            'description'        => nl2br($this->description),
            'slug'               => $this->getSlug(),
            'brand'              => new BrandResource($this->whenLoaded('brand')),
            'model'              => new ModelResource($this->whenLoaded('model')),
            'version'            => new VersionResource($this->whenLoaded('version')),
            'body_type'          => new BodyTypeResource($this->whenLoaded('body_type')),
            'status'             => new VehicleStatusResource($this->whenLoaded('status')),
            'transmissions'      => TransmissionResource::collection($this->whenLoaded('transmissions')),
            'cylinders'          => CylinderResource::collection($this->whenLoaded('cylinders')),
            'accessories'        => AccessoryResource::collection($this->whenLoaded('accessories')),
            'fuels'              => FuelResource::collection($this->whenLoaded('fuels')),
            'colors'             => ColorResource::collection($this->whenLoaded('colors')),
            'interior_colors'    => ColorResource::collection($this->whenLoaded('interior_colors')),
            'principal_images'   => FileResource::collection($this->principal_images),
            'three_sixty_images' => FileResource::collection($this->three_sixty_images),
            'interior_images'    => FileResource::collection($this->interior_images),
            'exterior_images'    => FileResource::collection($this->exterior_images),
            'images'             => FileResource::collection($this->images),
            'liked'              => $this->liked(),
            'inspections'        => InspectionResource::collection($this->whenLoaded('inspections')),
            'likes_count'        => $this->likes_count,
            'views_count'        => $this->views_count,
        ];
    }
}
