<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // index
    public function index()
    {
        // retrieve cart item of the user who loggen in 
        $cartItems = Cart::where("user_id", Auth::user()->id)->get();
        // Hitung subtotal per item
        $cartItems->map(function ($item) {
            $item->sub_total = $item->product->price * $item->quantity;
            return $item;
        });

        // Hitung total harga
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->sub_total;
        });
        return view('costumer.cart.index', compact('cartItems', 'totalPrice'));
    }

    // store item
    public function store(Request $request)
    {
        // validate the incoming req data before storing
        // then checj if item is already in cart
        // if not add to cart
        // then redirect back

        $validatedData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);

        // $userId = Auth::id();

        $cart = Cart::where('user_id', Auth::user()->id)->where('product_id', $validatedData['product_id'])->first();
        if ($cart) {
            // add the quantity of the existing item
            $cart->quantity = $cart->quantity + $validatedData['quantity'];
            $cart->save();
            return redirect()->back()->with('success', 'Quantity berhasil ditambahkan');
        } else {
            // store new item in cart
            $cart = Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $validatedData['product_id'],
                'quantity' => $validatedData['quantity'],
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // update quantity of item in cart
    public function updateQuantity(Request $request, $id)
    {
        // validate the incoming req data
        $validatedData = $request->validate([
            'quantity' => 'required',
        ]);

        // find the cart item and update the quantity
        $cartItem = Cart::find($id);
        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->save();

        return redirect('costumer.cart.index')->with('success', 'Quantity berhasil diubah');
    }

    // * method delete cart item
    // * menghapus item cart
    public function destroy($id)
    {
        // Find the cart item and delete it
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        // Redirect back to the cart page
        return redirect()->route('costumer.cart.index')->with('success', 'Produk dihapus dari keranjang');
    }
}
