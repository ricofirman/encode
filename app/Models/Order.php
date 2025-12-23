<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number','user_id',

        'customer_name','customer_email','customer_phone',

        'shipping_name','shipping_address','shipping_city','shipping_province','shipping_postal_code','shipping_phone',

        'subtotal','tax','shipping_cost','total',

        'payment_method','payment_status','status','notes',

        // midtrans fields (kalau kamu pakai)
        'snap_token','midtrans_order_id','transaction_id','payment_type','paid_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }
}