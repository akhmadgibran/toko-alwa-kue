<?php

namespace App\Http\Controllers;

use App\Models\ShopStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopStatusController extends Controller
{
    //
    public function adminIndex()
    {
        // retrieve shop status data id 1
        $shopstatus = ShopStatus::find(1);


        if (Auth::user()->usertype == 'admin') {
            return view('admin.shopstatus.index', compact('shopstatus'));
        } else {
            return view('admin.shopstatus.index', compact('shopstatus'));
        }
    }

    // to edit view
    public function edit()
    {
        $shopstatus = ShopStatus::find(1);
        return view('admin.shopstatus.edit', compact('shopstatus'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required|max:255',
        ]);

        // update data id 1
        $shopstatus = ShopStatus::find(1);
        $shopstatus->update($validatedData);

        if (Auth::user()->usertype == 'admin') {
            return redirect()->route('admin.shopstatus.index')->with('success', 'Shop Status Updated Successfully');
        } else {
            return redirect()->route('superadmin.shopstatus.index')->with('success', 'Shop Status Updated Successfully');
        }
    }
}
