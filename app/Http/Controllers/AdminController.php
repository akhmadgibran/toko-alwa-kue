<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\error;

class AdminController extends Controller
{
    // index for index page, showing all admin for superadmin user
    public function index()
    {
        $admins = User::where('usertype', 'admin')->get();
        return view('superadmin.admin.index', compact('admins'));
    }

    // create for create page
    public function create()
    {
        return view('superadmin.admin.create');
    }

    // store for adding new admin
    public function store(Request $request)
    {
        // validating incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);

        // email checking
        if (User::where('email', $validatedData['email'])->exists()) {
            return back()->with('error', 'Email already exists');
        }

        // encrypt password
        $validatedData['password'] = Hash::make($validatedData['password']);


        // store new user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'email_verified_at' => now(),
            'password' => $validatedData['password'],
            'phone' => $validatedData['phone'],
            'usertype' => 'admin',
            'address' => $validatedData['address']
        ]);


        // redirect after success
        return redirect()->route('superadmin.admin.index')->with('success', 'new admin added');
    }

    // function to create page
    public function edit($id)
    {
        // search admin
        $admin = User::find($id);
        // redirect to edit view
        return view('superadmin.admin.edit', compact('admin'));
    }

    // function to update admin
    public function update(Request $request, $id)
    {

        // cari data user tersebut
        $user = User::find($id);

        // validasi input request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'phone' => 'required|numeric',
            'address' => 'required'
        ]);
        // check if the email is the old one u can pass the email and if the email already exists u cant pass next step
        if ($user->email != $validatedData['email']) {
            if (User::where('email', $validatedData['email'])->exists()) {
                return back()->with('error', 'Email already exists');
            }
        }




        // encrypt password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // update data user
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'phone' => $validatedData['phone'],
            'usertype' => 'admin',
            'address' => $validatedData['address']
        ]);

        // redirect after success
        return redirect()->route('superadmin.admin.index')->with('success', 'admin updated');
    }

    // function to delete admin
    public function destroy($id)
    {
        // cari data user tersebut
        $user = User::find($id);

        // delete data user
        $user->delete();

        // redirect after success
        return redirect()->route('superadmin.admin.index')->with('success', 'admin deleted');
    }
}
