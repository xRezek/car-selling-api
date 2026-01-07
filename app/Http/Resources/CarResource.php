<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{

    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id" => $this->id,
            "maker" => $this->maker->name,
            "model" => $this->model->name,
            "year" => $this->year,
            "price" => $this->price,
            "vin" => $this->vin,
            "mileage" => $this->mileage,
            "fuelType" => $this->fuelType->name,
            "carType" => $this->carType->name,
            "user" => new UserResource($this->whenLoaded('owner')),
            "cityId" => $this->city->name,
            "address" => $this->address,
            "phone" => $this->phone,
            "description" => $this->description,
            "publishedAt" => $this->published_at,
            "createdAt" => $this->created_at->format("Y-m-d H:i:s"),

        ];
        
    }
}
