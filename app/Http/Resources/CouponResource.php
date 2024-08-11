<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CouponResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'discount' => intval($this->discount),
            'type' => $this->type,
            'start_at' => $this->start_at ? Carbon::parse($this->start_at)->format('Y-m-d') : null,
            'expired_at' => $this->expired_at ? Carbon::parse($this->expired_at)->format('Y-m-d') : null,
        ];
    }
}

