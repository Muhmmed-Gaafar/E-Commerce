<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'email',
        'city',
        'total',
        'status',
        'note',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
