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
        if (Auth::check()) {
            $user = Auth::user();
            return [
                'id' => $this->id,
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'address' => $user->address,
                'email' => $user->email,
                'city' => $user->city,
                'total' => intval($this->total),
                'status' => $this->status,
                'note' => $this->note,
            ];
        } else {
            return [
                'id' => $this->id ?? "",
                'user_id' => $this->user_id ?? "",
                'first_name' => $this->first_name ?? "",
                'last_name' => $this->last_name ?? "",
                'phone' => $this->phone ?? "",
                'address' => $this->address ?? "",
                'email' => $this->email ?? "",
                'city' => $this->city ?? "",
                'total' => intval($this->total),
                'status' => $this->status ?? "",
                'note' => $this->note ?? "",
            ];
        }
    }
}
