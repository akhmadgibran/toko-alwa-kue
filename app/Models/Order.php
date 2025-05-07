<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'custom_order_id',
        'user_id',
        'address',
        'total_price',
        'status',
        'buyer_note',
        'seller_note',
        'snap_token'
    ];
}
