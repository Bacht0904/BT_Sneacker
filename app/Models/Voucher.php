<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillabel = [
        'voucher_code',
        'description',
        'min_total_price',
        'discount_price',
        'start_date',
        'end_date',
        'status',
    ];
    use HasFactory;
}
