<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';
    protected $fillable = [
        'name',
        'code',
        'mobile',
        'email',
        'account_group',
        'remark',
        'is_supplier',
        'opening_gold',
        'gold_type',
        'opening_silver',
        'silver_type',
        'opening_rupees',
        'rupees_type',
        'price_per_pcs',
        'wastage',
    ];

   protected $casts = [
        'is_supplier' => 'boolean',
        'mobile' => 'array',
        'email' => 'array',
        'wastage' => 'array'
    ];
    
}
