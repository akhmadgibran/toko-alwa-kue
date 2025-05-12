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

        // * hitung subtotal per item
        $userCart->map(function ($item) {
            $item->subtotal = $item->product->price * $item->quantity;
            return $item;
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
                'custom_order_id' => $order->custom_order_id,
                'product_id' => $userCartitem->product_id,
                'quantity' => $userCartitem->quantity,
                'subtotal' => $userCartitem->subtotal,
            ]);
        }

        // * get the newly created order and  order details
        $order = Order::where('custom_order_id', $customOrderId)->first();
        $orderDetails = OrderDetail::where('custom_order_id', $order->custom_order_id)->get();

        if (!$order) {
            // Log an error or handle the case where the order is not found
            return redirect()->route('costumer.checkout.index')->with('error', 'Order not found.');
        }

        if (!$orderDetails) {
            // Log an error or handle the case where the order details are not found
            return redirect()->route('costumer.checkout.index')->with('error', 'Order details not found.');
        }

        // ! midtrans code
        // $transactionDetails = [
        //     'transaction_details' => [
        //         'order_id' => $order->custom_order_id,
        //         'gross_amount' => $totalPrice,
        //     ],
        //     'customer_details' => [
        //         'first_name' => Auth::user()->name,
        //         'email' => Auth::user()->email,
        //         'phone' => Auth::user()->phone,
        //     ],
        // ];

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->custom_order_id,
                'gross_amount' => $totalPrice,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                // 'last_name' => 'pratama',
                'email' => Auth::user()->email,
                'phone' =>  Auth::user()->phone,
            ),
        );

        // $snapToken = Snap::getSnapToken($transactionDetails);
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap_token ke order kalau perlu
        $order->snap_token = $snapToken;
        $order->save();

        // Kirim snapToken ke view checkout untuk digunakan client-side
        return view('costumer.checkout.payment', compact('snapToken', 'order', 'orderDetails'));

        // ! midtrans code end
    }

    public function success($custom_order_id)
    {
        // * ambil data order
        $order = Order::where('custom_order_id', $custom_order_id)->first();

        // // * ambil data order detail
        // $orderDetails = OrderDetail::where('order_id', $custom_order_id)->get();

        // * hapus cart
        Cart::where('user_id', Auth::user()->id)->delete();

        // rubah status order menjadi "Menunggu Konfirmasi"
        $order->status = 'Menunggu Verifikasi';
        $order->save();

        return view('costumer.checkout.success', compact('order'));
    }


    public function fail($custom_order_id)
    {
        // * ambil data order
        $order = Order::where('custom_order_id', $custom_order_id)->first();

        // rubah status order menjadi "Gagal"
        $order->status = 'Dibatalkan';
        $order->save();

        return view('costumer.checkout.fail', compact('order'));
    }
    public function pending($custom_order_id)
    {
        // * ambil data order
        $order = Order::where('custom_order_id', $custom_order_id)->first();

        // rubah status order menjadi "Menunggu Pembayaran"
        $order->status = 'Menunggu Pembayaran';
        $order->save();

        // return view('costumer.checkout.pending', compact('order'));
        return redirect()->route('costumer.order.index')->with('success', 'Pesanan anda sedang menunggu pembayaran');
    }

    public function pendingPayment($custom_order_id)
    {
        // * ambil data order
        $order = Order::where('custom_order_id', $custom_order_id)->first();

        // // rubah status order menjadi "Menunggu Pembayaran"
        // $order->status = 'Menunggu Pembayaran';
        // $order->save();

        return view('costumer.checkout.pending', compact('order'));
    }

    public function cancel($custom_order_id)
    {
        // * ambil data order
        $order = Order::where('custom_order_id', $custom_order_id)->first();

        // rubah status order menjadi "Dibatalkan"
        $order->status = 'Dibatalkan';
        $order->save();

        return view('costumer.checkout.cancel', compact('order'));
    }
}
