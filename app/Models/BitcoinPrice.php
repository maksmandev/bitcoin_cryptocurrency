<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitcoinPrice extends Model
{
    public $fillable = [
        'updated',
        'usd',
        'eur',
        'gbp',
    ];
}