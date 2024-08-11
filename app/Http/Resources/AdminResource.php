<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AdminResource extends JsonResource
{
    public function toArray($request)
    {
        $token = $this->createToken($this->name)->plainTextToken;


        return [
            'id' => $this->id??"",
            'name' => $this->name??"",
            'image' =>  $this->image??"",
            'email' => $this->email??"",
            'token' => $token
        ];
    }
}
