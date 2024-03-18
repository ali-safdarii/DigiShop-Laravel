<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         $lastTwoParents = $this->getLastTwoParentCategories();
         $lastTwoParentNames = implode(' / ', array_map(function ($category) {
             return $category->name;
         }, $lastTwoParents));


        return [
             'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'image_sizes' => $this->image,
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'status' => $this->status,
            'show_in_menu' => $this->show_in_menu,
            'parent' => new ProductCategoryResource($this->whenLoaded('parent')),
            'children' => ProductCategoryResource::collection($this->whenLoaded('children')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'attributes' => CategoryAttributeResource::collection($this->whenLoaded('attributes')),
            'full_category_name' => $this->full_category_name,
            'last_two_parents' => $lastTwoParentNames ?:  $this->name ,


        ];
    }
}
