<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiamondStock extends Model
{
   protected $table = 'diamond_stocks';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'natural',
        'lab_grown',
        'cvd',
    ];
}
