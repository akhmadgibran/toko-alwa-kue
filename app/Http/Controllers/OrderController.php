<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function indexCostumer()
    {
        $costumerOrderItems = Order::where('user_id', Auth::user()->id)->paginate(4);

        return view('costumer.order.index', compact('costumerOrderItems'));
    }


    public function costumerOrderFiltered(Request $request)
    {
        $costumerOrderItems = Order::where('user_id', Auth::user()->id)->where('status', $request->status)->paginate(4);

        return view('costumer.order.index', compact('costumerOrderItems'));
        // return redirect()->route('user.order.index')->with('userOrderItems', $userOrderItems);
    }

    public function costumerShowOrder($custom_order_id)
    {
        $costumerOrderItem = Order::where('user_id', Auth::user()->id)->where('custom_order_id', $custom_order_id)->first();
        $costumerOrderDetail = OrderDetail::where('custom_order_id', $custom_order_id)->get();

        return view('costumer.order.show', compact('costumerOrderItem', 'costumerOrderDetail'));
    }

    public function indexAdmin()
    {
        $adminOrderItems = Order::latest()->paginate(4);
        // return view('admin.order.index', compact('adminOrderItems'));
        if (Auth::user()->usertype == "admin") {
            return view('admin.order.index', compact('adminOrderItems'));
        } elseif (Auth::user()->usertype == "superadmin") {
            return view('admin.order.index', compact('adminOrderItems'));
        }
    }



    public function adminOrderFiltered(Request $request)
    {
        $adminOrderItems = Order::where('status', $request->status)->latest()->paginate(4);
        // return view('admin.order.index', compact('adminOrderItems'));
        if (Auth::user()->usertype == "admin") {
            return view('admin.order.index')->with(compact('adminOrderItems'));
        } elseif (Auth::user()->usertype == "superadmin") {
            return view('admin.order.index')->with(compact('adminOrderItems'));
        }
    }

    public function adminShowOrder($custom_order_id)
    {
        $orderStatus = OrderStatus::all();
        $adminOrderItem = Order::where('custom_order_id', $custom_order_id)->first();
        $adminOrderDetail = OrderDetail::where('custom_order_id', $custom_order_id)->get();
        // return view('admin.order.show', compact('orderStatus', 'adminOrderItem', 'adminOrderDetail'));
        if (Auth::user()->usertype == "admin") {
            return view('admin.order.show')->with(compact('orderStatus', 'adminOrderItem', 'adminOrderDetail'));
        } elseif (Auth::user()->usertype == "superadmin") {
            return view('admin.order.show')->with(compact('orderStatus', 'adminOrderItem', 'adminOrderDetail'));
        }
    }


    public function adminUpdateOrder(Request $request, $custom_order_id)
    {
        $validatedData = $request->validate([
            'status' => 'required|exists:order_statuses,status',
            'seller_note' => 'nullable|string|max:255',
        ]);
        $order = Order::where('custom_order_id', $custom_order_id)->first();
        $order->status = $validatedData['status'];
        $order->seller_note = $validatedData['seller_note'];
        $order->save();
        // return view('admin.order.index')->with('success', 'Status pesanan berhasil diubah');

        if (Auth::user()->usertype == "admin") {
            return redirect()->route('admin.order.index')->with('success', 'Status pesanan berhasil diubah');
        } elseif (Auth::user()->usertype == "superadmin") {
            return redirect()->route('superadmin.order.index')->with('success', 'Status pesanan berhasil diubah');
        }
    }
}
