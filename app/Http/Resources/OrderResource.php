<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {


            $user = Auth::user();
            return [
                'id' => $this->id?? "",
                'user_id' => $user->id?? "",
                'first_name' => $user->first_name?? "",
                'last_name' => $user->last_name?? "",
                'phone' => $user->phone?? "",
                'address' => $user->address?? "",
                'email' => $user->email?? "",
                'city' => $user->city?? "",
                'total' => intval($this->total)?? "",
                'status' => $this->status?? "",
                'note' => $this->note?? "",
                'order_items' => OrderItemResource::collection($this->orderItems),
            ];

    }
}
