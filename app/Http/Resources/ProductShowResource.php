<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProductShowResource extends JsonResource
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
            'id' => $this->id ?? "",
            'title' => $this->title ?? "",
            'description' => $this->description ?? "",
            'image' => $this->image ?? "",
            'rate' => intval($this->rate) ?? 0,
            'price' => intval($this->price) ?? 0,
            'tax' => intval($this->tax) ?? 0,
            'price_after_tax' => (intval($this->price) + intval($this->tax)) ?? 0,
            'date' => $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : null,
            'stock' => $this->stock??"",
            'parent_id' => [
                'id' => intval($this->parent_id) ?? "",
                'title' => $this->title ,
            ],
            'category' => [
                'id' => $this->category_id ?? "",
                'title' => $this->category ? $this->category->title : null,
            ],
            'colors' => $this->colors ? $this->colors->map(function ($color) {
                return [
                    'id' => $color->id,
                    'color' => $color->color
                ];
            }) : [],
            'types' => $this->types ? $this->types->map(function ($type) {
                return [
                    'id' => $type->id,
                    'type' => $type->type
                ];
            }) : [],
            'sizes' => $this->sizes ? $this->sizes->map(function ($size) {
                return [
                    'id' => $size->id,
                    'size' => $size->size
                ];
            }) : [] ,
            'images' => $this->images ? $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'img_url' => $image->image
                ];
            }) : [],
            'reviews' => $this->reviews ? $this->reviews->map(function ($review) {
                return [
                    'id' => $review->id,
                    'name' => $review->name,
                    'rate' => $review->rate,
                    'comment' => $review->comment,
                ];
            }) : []
        ];
    }
}


