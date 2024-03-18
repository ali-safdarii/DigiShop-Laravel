<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmazingSaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    //public static $wrap = 'items';

    public function toArray(Request $request): array
    {
        return [
            //            'product_id' => $this->product_id ,
            'id' => $this->id,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'percentage' => $this->percentage,
            'product' => new ProductResource($this->product),
        ];
    }
}
