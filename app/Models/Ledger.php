<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledgers';
    
    protected $fillable = [
        'date',
        'particulars',
        'type',
        'gross_weight',
        'less_weight',
        'net_weight',
        'tunch',
        'wastage',
        'gold_fine',
        'silver_fine',
        'amount',
        'reference_no',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
