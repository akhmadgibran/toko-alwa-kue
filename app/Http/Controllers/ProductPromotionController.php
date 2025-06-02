<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductPromotion;
use Illuminate\Support\Facades\Auth;

class ProductPromotionController extends Controller
{
    //
    public function index()
    {
        $productPromotionItems = ProductPromotion::all();
        // retreive all products
        $products = Product::all();

        if (Auth::user()->usertype == 'superadmin') {
            return view('admin.product-promotion.index', compact('productPromotionItems', 'products'));
        } else {
            return view('admin.product-promotion.index', compact('productPromotionItems', 'products'));
        }
    }


    public function update(Request $request, $id)
    {
        // validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'nullable|exists:products,id',
        ]);

        // find the product promotion item and update the product_id
        $productPromotionItem = ProductPromotion::find($id);
        $productPromotionItem->product_id = $validatedData['product_id'];
        $productPromotionItem->save();

        if (Auth::user()->usertype == 'superadmin') {
            return redirect()->route('superadmin.productpromotion.index')->with('success', 'Best seller updated successfully!');
        } else {
            return redirect()->route('admin.productpromotion.index')->with('success', 'Best seller updated successfully!');
        }
    }
}
