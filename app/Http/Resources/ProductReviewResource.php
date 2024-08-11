<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id??"",
            'name' => $this->name??"",
            'rate' => $this->rate??"",
            'comment' => $this->comment??"",
            'product_id' => $this->product_id??"",
            'created_at' => $this->created_at->format('Y-m-d')??""
        ];
    }
}

