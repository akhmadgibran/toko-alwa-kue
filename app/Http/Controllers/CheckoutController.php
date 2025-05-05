<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //

    public function index()
    {
        // * ambil data cart
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();
        // Hitung subtotal per item
        $cartItems->map(function ($item) {
            $item->sub_total = $item->product->price * $item->quantity;
            return $item;
        });

        // * hitung total price
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // * ambil alamat costumer
        $costumerAddress = Auth::user()->address;

        // * ambil nama costumer
        $costumerName = Auth::user()->name;

        // * ambil nomor whatsapp costumer
        $costumerPhone = Auth::user()->phone;

        // * ambil nomor telepon admin
        $adminPhone = User::where('usertype', 'admin')->first()->phone;

        // * kirim data ke view
        return view('costumer.checkout.index', compact('cartItems', 'totalPrice', 'adminPhone', 'costumerAddress', 'costumerName', 'costumerPhone'));
    }
}
