<?php

namespace App\Http\Resources;

use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product_count = $this->products()->count();

        return [
            'id'=>$this->id??"",
            'title'=>$this->title??"",
            'description'=>$this->description??"",
            'status'=> intval($this->status)??"",
            'image' => $this->image??"",
            'parent_id'=>$this->parent_id??"",
            'count_products' => $this->products->count(),

        ];

    }
}
