<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BestSellerController extends Controller
{
    // index for admin
    public function index()
    {
        $bestSellerItems = BestSeller::all();
        // retreive all products
        $products = Product::all();

        if (Auth::user()->usertype == 'superadmin') {
            return view('admin.best-seller.index', compact('bestSellerItems', 'products'));
        } else {
            return view('admin.best-seller.index', compact('bestSellerItems', 'products'));
        }
    }


    public function update(Request $request, $id)
    {
        // validate the incoming request data
        $validatedData = $request->validate([
            'product_id' => 'required',
        ]);

        // find the best seller item and update the product_id
        $bestSellerItem = BestSeller::find($id);
        $bestSellerItem->product_id = $validatedData['product_id'];
        $bestSellerItem->save();

        if (Auth::user()->usertype == 'superadmin') {
            return redirect()->route('superadmin.bestseller.index')->with('success', 'Best seller updated successfully!');
        } else {
            return redirect()->route('admin.bestseller.index')->with('success', 'Best seller updated successfully!');
        }
    }
}
