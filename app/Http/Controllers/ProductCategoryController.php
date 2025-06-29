<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductCategoryController extends Controller
{
    // index
    public function adminIndex()
    {
        // retrieve all categories
        $categories = ProductCategory::simplePaginate(6);

        // pass categories to view
        return view('admin.product-category.index', compact('categories'));
    }

    // index for user
    public function index()
    {
        $categories = ProductCategory::simplePaginate(4);

        return view('product-categories-page', compact('categories'));
    }

    // create view (form input)
    public function create()
    {
        return view('admin.product-category.create');
    }

    // store data

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image to storage and get the path
        $imagePath = $request->file('image')->store('product_categories', 'public');

        // Create a new product category record
        ProductCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        if (Auth::user()->usertype == 'superadmin') {
            return redirect()->route('superadmin.category.index')->with('success', 'Product category created successfully');
        } else {
            return redirect()->route('admin.category.index')->with('success', 'Product category created successfully');
        }
    }



    // edit view (form input)
    public function edit($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        return view('admin.product-category.edit', compact('productCategory'));
    }

    // update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $productCategory = ProductCategory::findOrFail($id);



        // if a new image is uploaded update it 
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($productCategory->image_path) {
                Storage::disk('public')->delete($productCategory->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('product_categories', 'public');
            $productCategory->image_path = $imagePath;
        }

        // Update the product category record
        $productCategory->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $productCategory->image_path,
        ]);

        if (Auth::user()->usertype == "admin") {
            return redirect()->route('admin.category.index')->with('success', 'Product category updated successfully');
        } else {
            return redirect()->route('superadmin.category.index')->with('success', 'Product category updated successfully');
        }
    }


    // delete
    public function destroy($id)
    {
        $productCategory = ProductCategory::findOrFail($id);
        if ($productCategory->image_path) {
            Storage::disk('public')->delete($productCategory->image_path);
        }

        $productCategory->delete();

        if (Auth::user()->usertype == "admin") {
            return redirect()->route('admin.category.index')->with('success', 'Product category deleted successfully');
        } else {
            return redirect()->route('superadmin.category.index')->with('success', 'Product category deleted successfully');
        }
    }
}
