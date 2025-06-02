<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {

        // count orders that have status "Menunggu Pembayaran" and "Dalam Proses"
        $orderWaitingVerifications = DB::table("orders")->where("status", "Menunggu Verifikasi")->count();
        $orderOnProcess = DB::table("orders")->where("status", "Dalam Proses")->count();
        $ordersNeedAttention = $orderWaitingVerifications + $orderOnProcess;

        // cout order that have status "Delivery"
        $ordersInDelivery = DB::table("orders")->where("status", "Delivery")->count();

        $ordersAlreadyDone = DB::table("orders")->where("status", "Selesai")->count();

        return view("admin.dashboard", compact("ordersNeedAttention", "ordersInDelivery", "ordersAlreadyDone"));
    }
}
