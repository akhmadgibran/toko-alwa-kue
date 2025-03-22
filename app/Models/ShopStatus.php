<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopStatus extends Model
{
    //
    protected $table = 'shop_statuses';
    protected $fillable = ['name', 'description'];
}
