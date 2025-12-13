<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockStatus extends Model
{
    protected $table = 'stock_statuses';
     protected $fillable = [
        'item_code',
        'item_name',
        'category',
        'weight',
        'purity',
        'quantity',
        'status',
        'rfid',
    ];
}
