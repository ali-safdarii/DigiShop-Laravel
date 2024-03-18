<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $decodedValue = json_decode($this->value, true); // Decode the JSON-encoded value
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'category_attribute_id' => $this->category_attribute_id,
            'decoded_value' => $decodedValue,
            'attribute' => new CategoryAttributeResource($this->whenLoaded('attribute')),
            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
