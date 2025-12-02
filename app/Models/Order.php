<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table="orders";
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
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
