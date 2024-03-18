<?php

namespace App\Http\Resources;

use App\Utili\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use function MongoDB\BSON\toJSON;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */




    public function toArray(Request $request): array
    {

        // Calculate discount information if available
        $helper = new Helper();
        $discountPercentage = $this->activeDiscount() ? $this->activeDiscount()->percentage : 0;
        $discountAmount = $this->activeDiscount() ? ($this->price * $discountPercentage) / 100 : 0;
        $finalPrice = $this->activeDiscount() ? $this->price - ($this->price * $discountPercentage / 100) : $this->price;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (int) $this->price,
            'model_name' => $this->model_name,
            'introduction' => $this->introduction,
            'slug' => $this->slug,
            'image_sizes' => $this->image,
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'status' => $this->status,
            'marketable' => $this->marketable,
            'sold_number' => $this->sold_number,
            'frozen_number' => $this->frozen_number,
            'marketable_number' => $this->marketable_number,
            'default_color_id' => $this->default_color_id,
            'discounts' => $this->activeDiscount() ? [
                'percentage' => $discountPercentage,
                'discountAmount' => (int) $discountAmount,
                'finalPrice' => (int) $finalPrice,
                'start_date' => $this->activeDiscount()->start_date,
                'end_date' => $this->activeDiscount()->end_date
            ] : null,
            'tags' => TagResource::collection($this->tags),
            'brand' => new BrandResource($this->brand),
            'category' => new ProductCategoryResource($this->category),
            'metas' => ProductMetaResource::collection($this->metas),
            'colors' => ColorResource::collection($this->colors),
            'galleries' => ProductGalleryResource::collection($this->images),
            'is_favorite' => (bool) random_int(0, 1),
            'values' => CategoryValueResource::collection($this->values),
            'guarantees' => GuaranteesResource::collection($this->guarantees),
            'comments' => CommentResource::collection($this->comments),
            // Include other relationships using the appropriate resource classes
            'height' => $this->height,
        ];
    }

}
