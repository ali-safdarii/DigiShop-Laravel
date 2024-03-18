<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
           'qty' => $this->qty,
           'final_price' => $this->final_price,
           'product' => new ProductResource($this->product),
           'color' => new ColorResource($this->color),


       ];
    }


}
