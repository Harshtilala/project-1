<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';
    protected $fillable = [
        'categoryName',
        'itemName',
        'shortItemName',
        'dleNo',
        'designNo',
        'minOrderQty',
        'defaultWastage',
        'lessOption',
        'stockTransferWastage',
        'itemImage',
        'stockMethod',
        'sequenceNo',
        'rateNo',
        'rateOff'
    ];
}
