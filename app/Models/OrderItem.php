<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'category',
        'item',
        'tunch',
        'weight',
        'pcs',
        'size',
        'length',
        'hook_style',
        'remark',
        'image',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
