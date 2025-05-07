<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Cart;
use App\Models\User;
use Midtrans\Config;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    //

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }


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


    public function store(Request $request)
    {

        // * validasi data masuk
        $validatedData = $request->validate([
            'buyer_note' => 'required',
        ]);

        // * ambil data yang dibutuhkan dari costumer tersebut
        $userID = Auth::user()->id;
        $address = Auth::user()->address;
        $carts = Cart::where('user_id', $userID);
        $userCart = $carts->get();

        // * hitung total price
        $totalPrice = $userCart->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $customOrderId = 'INV-' . strtoupper(Str::random(5)) . '-' . time();

        // * make new order /transaction
        $order = Order::create([
            'custom_order_id' => $customOrderId,
            'user_id' => $userID,
            'address' => $address,
            'total_price' => $totalPrice,
            'buyer_note' => $validatedData['buyer_note'],
        ]);

        //  * make new order detail
        foreach ($userCart as $userCartitem) {
            OrderDetail::create([
                'order_id' => $order->custom_order_id,
                'product_id' => $userCartitem->product_id,
                'quantity' => $userCartitem->quantity,
            ]);
        }

        // * get the newly created order and  order details
        $order = Order::where('custom_order_id', $customOrderId)->first();
        $orderDetails = OrderDetail::where('order_id', $order->custom_order_id)->get();

        // ! midtrans code
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $order->custom_order_id,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($transactionDetails);

        // Simpan snap_token ke order kalau perlu
        $order->snap_token = $snapToken;
        $order->save();

        // Kirim snapToken ke view checkout untuk digunakan client-side
        return view('costumer.checkout.payment', compact('snapToken', 'order', 'orderDetails'));

        // ! midtrans code end
    }
}
