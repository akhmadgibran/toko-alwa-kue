<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use App\Models\ShopStatus;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

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

        $bestSellerItems = BestSeller::all();
        $bestSellerId1 = $bestSellerItems->where('id', 1)->first();
        $bestSellerId2 = $bestSellerItems->where('id', 2)->first();
        $bestSellerId3 = $bestSellerItems->where('id', 3)->first();
        // if best seller id "1" exist but have product_id column is null then make $bestSellerItems empty
        if ($bestSellerItems->every(fn($item) => is_null($item->product_id))) {
            $bestSellerItems = collect();
        }
        $productCategories = ProductCategory::all();
        $siteSettings = SiteSetting::first();
        return view("homeV2", compact("bestSellerItems", "productCategories", 'bestSellerId1', 'bestSellerId2', 'bestSellerId3', 'siteSettings'));
    }

    public function about()
    {
        $siteSettings = SiteSetting::first();
        return view("about-us", compact('siteSettings'));
    }
}
