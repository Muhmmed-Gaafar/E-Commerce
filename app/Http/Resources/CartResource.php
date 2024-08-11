<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id??"",
            'user_id' => $this->user_id??"",
            'product_id' => $this->product_id??"",
            'quantity' => $this->quantity??"",
//            'user' => new UserResource($this->whenLoaded('user')),
//            'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}

