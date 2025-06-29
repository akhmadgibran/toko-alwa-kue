<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function adminIndex()
    {
        // retrieve all product
        $products = Product::simplePaginate(6);

        // pass products to view
        return view('admin.product.index', compact('products'));
    }

    // index costumer / guest
    public function index($id)
    {
        // retrieve data product by category id
        $products = Product::where('category_id', $id)->simplePaginate(6);

        return view('products-page', compact('products'));
    }

    // show
    public function show($id)
    {
        // retriee detail of product by the recieved id
        $product = Product::findOrFail($id);
        return view('product-detail', compact('product'));
    }

    // create
    public function create()
    {
        // retrieve all categories for product
        $categories = ProductCategory::all();

        return view('admin.product.create', compact('categories'));
    }

    // store
    public function store(Request $request)
    {
        // dd($request);
        // validasi 
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'required|image',
        ]);

        // Upload image to storage and get the path
        $imagePath = $request->file('image')->store('products', 'public');

        // Create a new product record
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image_path' => $imagePath,
        ]);

        if (Auth::user()->usertype == 'superadmin') {
            return redirect()->route('superadmin.product.index')->with('success', 'Product created successfully');
        } else {
            return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
        }
    }

    // edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = ProductCategory::all();
        return view('admin.product.edit', compact(['product', 'categories']));
    }

    // update
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $product->update($validatedData);

        // return response()->json([$product, $request->all()]);

        if (Auth::user()->usertype == "admin") {
            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully!');
        } else {
            return redirect()->route('superadmin.product.index')->with('success', 'Product updated successfully!');
        }
    }




    // destroy
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        if (Auth::user()->usertype == "admin") {
            return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully');
        } else {
            return redirect()->route('superadmin.product.index')->with('success', 'Product deleted successfully');
        }
    }
}
