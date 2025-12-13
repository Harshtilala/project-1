<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karat extends Model
{
    protected $table = 'karats';

    protected $fillable = [
        'name',
        'stock_22k',
        'stock_18k',
        'stock_14k',
    ];
}
