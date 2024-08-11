<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'discount',
        'type',
        'start_at',
        'expired_at',
    ];

    protected $dates = [
        'start_at',
        'expired_at',
    ];

    public $timestamps = false;
}

