<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPromotion extends Model
{
    //
    protected $table = "product_promotions";

    protected $fillable = ["product_id", "id",];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
