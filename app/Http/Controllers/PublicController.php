<?php

namespace App\Http\Controllers;

use App\Models\BestSeller;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    //
    public function home()
    {
        $bestSellerItems = BestSeller::all();
        return view("homeV2", compact("bestSellerItems"));
    }
}
