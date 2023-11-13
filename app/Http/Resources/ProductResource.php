<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title"=> $this->title,
            "description"=> $this->description,
            "image"=> $this->image,
            "category"=> $this->category,
            "quantity"=> $this->quantity,
            "price"=> $this->price,
            "discount_price"=> $this->discount_price,
            "quantity"=> $this->quantity,
        ];
    }
}
