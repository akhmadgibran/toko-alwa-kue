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
        return view('admin.order.index', compact('adminOrderItems'));
    }


    // public function adminOrderFiltered(Request $request)
    // {
    //     $adminOrderItems = Order::where('status', $request->status)->latest()->paginate(4);
    //     return view('admin.order.index', compact('adminOrderItems'));
    // }

    // public function adminShowOrder($id)
    // {
    //     $orderStatus = OrderStatus::all();
    //     $adminOrderItem = Order::where('id', $id)->first();
    //     $adminOrderDetail = OrderDetail::where('order_id', $adminOrderItem->id)->get();
    //     return view('admin.order.show', compact('orderStatus', 'adminOrderItem', 'adminOrderDetail'));
    // }

    // public function adminUpdateOrder(Request $request, $id)
    // {
    //     $order = Order::find($id);
    //     $order->status = $request->status;
    //     $order->seller_note = $request->seller_note;
    //     $order->save();
    //     return redirect()->route('admin.order.index')->with('success', 'Status pesanan berhasil diubah');
    // }
}
