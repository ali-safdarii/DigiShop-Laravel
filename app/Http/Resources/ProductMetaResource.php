<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'meta_key' => $this->meta_key,
            'meta_value' => $this->meta_value,
            'product_id' => $this->product_id,
            'product' => new ProductResource($this->whenLoaded('product')),

        ];
    }
}
