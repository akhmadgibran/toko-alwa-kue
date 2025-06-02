<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use App\Models\ShopStatus;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\ProductPromotion;

class PublicController extends Controller
{
    //
    public function home()
    {
        $statusToko = ShopStatus::all();

        if ($statusToko[0]->name == 'open') {
            $statusToko = 'open';
        } else {
            $statusToko = 'closed';
        }

        $productPromotionItems = ProductPromotion::all();
        $productPromotionId1 = $productPromotionItems->where('id', 1)->first();
        $productPromotionId2 = $productPromotionItems->where('id', 2)->first();
        $productPromotionId3 = $productPromotionItems->where('id', 3)->first();
        // if best seller id "1" exist but have product_id column is null then make $bestSellerItems empty
        if ($productPromotionItems->every(fn($item) => is_null($item->product_id))) {
            $productPromotionItems = collect();
        }
        $productCategories = ProductCategory::all();
        $siteSettings = SiteSetting::first();
        return view("home", compact("productPromotionItems", "productCategories", 'productPromotionId1', 'productPromotionId2', 'productPromotionId3', 'siteSettings'));
    }
}
