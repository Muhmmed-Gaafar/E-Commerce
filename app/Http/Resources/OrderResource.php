<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id??"",
            'user_id' => $this->user_id??"",
            'first_name' => $this->first_name??"",
            'last_name' => $this->last_name??"",
            'phone' => $this->phone??"",
            'address' => $this->address??"",
            'email' => $this->email??"",
            'city' => $this->city??"",
            'total' => intval($this->total),
            'status' => $this->status??"",
            'note' => $this->note??"",

        ];
    }
}
