<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_number',
        'status',
        'total_price',
        'payment_method',
        'snap_token',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
