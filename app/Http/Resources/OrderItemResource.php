<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request)
    {

        $priceAfterTax = $this->product->price + $this->product->tax;
        $totalPrice = $this->quantity * $priceAfterTax;

        return [
            'id' => $this->id,
            'order_id' => intval($this->order_id),
            'product_id' => intval($this->product_id),
            'product_price'=> $this->product->price,
            'product_tax'=> $this->product->tax ,
            'quantity' => intval($this->quantity),
            'price' => $totalPrice,
        ];
    }
}

