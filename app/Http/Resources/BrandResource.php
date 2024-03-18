<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'name' => $this->name,
            'persian_name' => $this->persian_name,
            'description' => $this->description,
            'slug' => $this->slug,
            'image_sizes' => $this->image,
            'status' => $this->status,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),

        ];
    }
}
