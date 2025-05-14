<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class PublicController extends Controller
{
    //
    public function home()
    {
        $bestSellerItems = BestSeller::all();
        $bestSellerId1 = $bestSellerItems->where('id', 1)->first();
        $bestSellerId2 = $bestSellerItems->where('id', 2)->first();
        $bestSellerId3 = $bestSellerItems->where('id', 3)->first();
        $productCategories = ProductCategory::all();
        return view("homeV2", compact("bestSellerItems", "productCategories", 'bestSellerId1', 'bestSellerId2', 'bestSellerId3'));
    }
}
