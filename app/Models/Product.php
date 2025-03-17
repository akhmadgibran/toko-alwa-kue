<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'product_category_id',
    ];


    // relationship : a product belongs to a category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
