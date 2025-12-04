<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'department',
        'type',
        'order_date',
        'date',
        'real_delivery_date',
        'gold_price',
        'party_name',
        'to_supplier',
        'silver_price',
        'delivery_date',
        'remark',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime', // or 'date' if you only need Y-m-d
        'delivery_date' => 'datetime',
        'real_delivery_date' => 'datetime',
        'order_date' => 'datetime',
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
