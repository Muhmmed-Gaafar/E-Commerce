<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id??"",
            'title' => $this->title??"",
            'description' => $this->description??"",
            'image' => $this->image??"",
            'category_id' => $this->category_id ??"" ,
            'category' => $this->category?->title??"",
            'rate' => intval($this->rate)??"",
            'price' => intval($this->price) ??"",
            'tax' => intval($this->tax)??"",
            'price_after_tax'=>$this->price + $this->tax ??"",
            'stock' => $this->stock??"",

        ];
    }
}

